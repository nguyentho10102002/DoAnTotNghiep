<?php

namespace App\Traits;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait {



public function uploadImage(Request $request, $inputName, $path)
{
    if ($request->hasFile($inputName)) {

        $image = $request->{$inputName};
        // Khởi tạo Guzzle client
        $client = new Client();

        try {
            // Gửi ảnh tới FastAPI để nhận diện thương hiệu
            $response = $client->post(env('FASTAPI_URL'), [
                'multipart' => [
                    [
                        'name'     => 'image', // Key của trường ảnh trong request FastAPI
                        'contents' => fopen($image->getRealPath(), 'r'), // Đọc file ảnh
                        'filename' => $image->getClientOriginalName(), // Tên file ảnh
                    ]
                ]
            ]);

            // Lấy dữ liệu trả về từ FastAPI
            $data = json_decode($response->getBody()->getContents(), true);

            // Kiểm tra nếu có dữ liệu predictions từ FastAPI
            if (isset($data['predictions']) && count($data['predictions']) > 0) {
                // Lấy phần tử đầu tiên trong mảng predictions
                $firstPrediction = $data['predictions'][0];

                // Kiểm tra nếu label là "adidas"
                if (isset($firstPrediction['label']) && $firstPrediction['label'] === 'adidas') {
                    // Tạo tên file cho ảnh
                    $ext = $image->getClientOriginalExtension();
                    $imageName = 'media_' . uniqid() . '.' . $ext;

                    // Di chuyển ảnh vào thư mục mong muốn
                    $image->move(public_path($path), $imageName);

                    // Trả về đường dẫn ảnh đã lưu
                    return $path . '/' . $imageName;
                } else {
                    // Nếu label không phải "adidas", trả về thông báo lỗi
                    return response()->json(['error' => 'Thương hiệu không khớp.'], 400);
                }
            }

            // Nếu không có predictions hoặc không có label hợp lệ, trả về lỗi
            return response()->json(['error' => 'Không nhận diện được thương hiệu.'], 400);

        } catch (\Exception $e) {
            // Xử lý lỗi khi gửi ảnh tới FastAPI
            return response()->json(['error' => 'Lỗi khi gửi ảnh tới FastAPI: ' . $e->getMessage()], 500);
        }

    }

    // Nếu không có ảnh
    return response()->json(['error' => 'Không có file ảnh.'], 400);
}



    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];

        if ($request->hasFile($inputName)) {

            $images = $request->{$inputName};

            foreach ($images as $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_' . uniqid() . '.' . $ext;

                $image->move(public_path($path), $imageName);

                $imagePaths[] =  $path . '/' . $imageName;
            }

            return $imagePaths;
        }
    }


    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    /** Handle Delte File */
    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }


    public function validateImage(Request $request, $inputName, $path)
    {

        if (!$request->hasFile($inputName)) {
            return response()->json(['error' => 'Không có file ảnh.'], 400);
        }


        $image = $request->{$inputName};
        // Khởi tạo Guzzle client
        $client = new Client();

        try {
            // Gửi ảnh tới FastAPI để nhận diện thương hiệu
            $response = $client->post(env('FASTAPI_URL'), [
                'multipart' => [
                    [
                        'name'     => 'image', // Key của trường ảnh trong request FastAPI
                        'contents' => fopen($image->getRealPath(), 'r'), // Đọc file ảnh
                        'filename' => $image->getClientOriginalName(), // Tên file ảnh
                    ]
                ]
            ]);

            // Lấy dữ liệu trả về từ FastAPI
            $data = json_decode($response->getBody()->getContents(), true);
            ///Get lable after check
            $firstPrediction = $data['predictions'][0];
            return $firstPrediction['label'] ?? '';
        } catch (\Exception $e) {
            // Xử lý lỗi khi gửi ảnh tới FastAPI
            return response()->json(['error' => 'Lỗi khi gửi ảnh tới FastAPI: ' . $e->getMessage()], 500);
        }
    }
}

