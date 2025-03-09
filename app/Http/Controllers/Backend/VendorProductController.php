<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:3000',
            'brand' => 'required'
        ]);
        $image = $request->file('image');
        $imagePath = $image->getPathname();
        $imageName = $image->getClientOriginalName();
        $response = Http::attach('image', file_get_contents($imagePath), $imageName)->post('http://127.0.0.1:8080/predict/');

        if ($response->successful()) {
            if (isset($response->json()['predictions'])) {
                $predictions = $response->json()['predictions'];

                $selectedBrand = DB::table('brands')->where('id', $request->input('brand'))->first();


                $isBrandMatched = false; // Kiểm tra xem thương hiệu đã chọn có khớp với dự đoán từ API hay không
                foreach ($predictions as $prediction) {
                    if ($prediction['label'] == strtolower($selectedBrand->name)) {
                        $isBrandMatched = true;
                    }
                    if ($isBrandMatched) {
                        $request->validate([
                            'image' => ['nullable', 'image', 'max:3000'],
                            'name' => ['required', 'max:200'],
                            'category' => ['required'],
                            'price' => ['required'],
                            'qty' => ['required'],
                            'short_description' => ['required', 'max: 600'],
                            'long_description' => ['required'],
                            'seo_title' => ['nullable', 'max:200'],
                            'seo_description' => ['nullable', 'max:250'],
                            'status' => ['required']
                        ]);
                        /** Handle the image upload */
                        // UPload image mà imagePath không có thì là check không ra . kiểm tra imagePath rồi thông báo hay xử lý chi ra FE
                        // như răng thì tùy m. t chịu. nhớ là mà fail thì return chứ xử lý tiếp rồi lưu vào database thì nhót.


                        $imageName = 'media_' . uniqid() . '.' . $image->getClientOriginalExtension();

                        $image->move(public_path('uploads'), $imageName);
                        $imageFullPath = 'uploads/' . $imageName;


                        $product = new Product();
                        $product->thumb_image = $imageFullPath;
                        $product->name = $request->name;
                        $product->slug = Str::slug($request->name);
                        $product->vendor_id = Auth::user()->vendor->id;
                        $product->category_id = $request->category;
                        $product->sub_category_id = $request->sub_category;
                        $product->child_category_id = $request->child_category;
                        $product->brand_id = $request->brand;
                        $product->qty = $request->qty;
                        $product->short_description = $request->short_description;
                        $product->long_description = $request->long_description;
                        $product->video_link = $request->video_link;
                        $product->sku = $request->sku;
                        $product->price = $request->price;
                        $product->offer_price = $request->offer_price;
                        $product->offer_start_date = $request->offer_start_date;
                        $product->offer_end_date = $request->offer_end_date;
                        $product->product_type = $request->product_type;
                        $product->status = $request->status;
                        $product->is_approved = 1;
                        $product->seo_title = $request->seo_title;
                        $product->seo_description = $request->seo_description;
                        $product->save();

                        toastr('Tạo mới thành công!', 'success');

                        return redirect()->route('vendor.products.index');
                    } else {
                        // return back()->with('error', 'Thương hiệu trong ảnh không khớp với thương hiệu đã chọn.');
                        // dd('không trùng khớp');
                        toastr('Đăng bán thất bại kiểm tra lại sản phẩm!', 'error');
                        return back();
                    }
                }
            } else {
                toastr('Đăng bán thất bại kiểm tra lại sản phẩm!', 'error');
                return back();
            }
        } else {
            toastr('Đăng bán thất bại kiểm tra lại sản phẩm!', 'error');
            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        /** Check if it's the owner of the product */
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('vendor.product.edit',
        compact(
            'product',
            'subCategories',
            'childCategories',
            'categories',
            'brands'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'image' => 'required|image|max:3000',
            'brand' => 'required'
        ]);
        if(($request->hasFile('image'))){
            $image = $request->file('image');
            $imagePath = $image->getPathname();
            $imageName = $image->getClientOriginalName();
        }else{
            $imagePath = public_path($product->thumb_image);
            $imageName = basename($product->thumb_image);
        }

        $response = Http::attach('image', file_get_contents($imagePath), $imageName)->post('http://127.0.0.1:8080/predict/');

        if ($response->successful()) {
            if (isset($response->json()['predictions'])) {
                $predictions = $response->json()['predictions'];

                $selectedBrand = DB::table('brands')->where('id', $request->input('brand'))->first();


                $isBrandMatched = false; // Kiểm tra xem thương hiệu đã chọn có khớp với dự đoán từ API hay không
                foreach ($predictions as $prediction) {
                    if ($prediction['label'] == strtolower($selectedBrand->name)) {
                        $isBrandMatched = true;
                    }
                    if ($isBrandMatched) {


                        $request->validate([
                            'image' => ['nullable', 'image', 'max:3000'],
                            'name' => ['required', 'max:200'],
                            'category' => ['required'],
                            'brand' => ['required'],
                            'price' => ['required'],
                            'qty' => ['required'],
                            'short_description' => ['required', 'max: 600'],
                            'long_description' => ['required'],
                            'seo_title' => ['nullable', 'max:200'],
                            'seo_description' => ['nullable', 'max:250'],
                            'status' => ['required']
                        ]);



                        if ($product->vendor_id != Auth::user()->vendor->id) {
                            abort(404);
                        }

                        /** Handle the image upload */
                        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

                        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
                        $product->name = $request->name;
                        $product->slug = Str::slug($request->name);
                        $product->vendor_id = Auth::user()->vendor->id;
                        $product->category_id = $request->category;
                        $product->sub_category_id = $request->sub_category;
                        $product->child_category_id = $request->child_category;
                        $product->brand_id = $request->brand;
                        $product->qty = $request->qty;
                        $product->short_description = $request->short_description;
                        $product->long_description = $request->long_description;
                        $product->video_link = $request->video_link;
                        $product->sku = $request->sku;
                        $product->price = $request->price;
                        $product->offer_price = $request->offer_price;
                        $product->offer_start_date = $request->offer_start_date;
                        $product->offer_end_date = $request->offer_end_date;
                        $product->product_type = $request->product_type;
                        $product->status = $request->status;
                        $product->is_approved = $product->is_approved;
                        $product->seo_title = $request->seo_title;
                        $product->seo_description = $request->seo_description;
                        $product->save();

                        toastr('Đã cập nhật thành công!', 'success');

                        return redirect()->route('vendor.products.index');
                    } else {
                        // return back()->with('error', 'Thương hiệu trong ảnh không khớp với thương hiệu đã chọn.');
                        // dd('không trùng khớp');
                        toastr('Đăng bán thất bại kiểm tra lại sản phẩm!', 'error');
                        return back();
                    }
                }
            } else {
                toastr('Đăng bán thất bại kiểm tra lại sản phẩm!', 'error');
                return back();
            }
        } else {
            toastr('Đăng bán thất bại kiểm tra lại sản phẩm!', 'error');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Delte the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Đã xóa thành công!']);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Trạng thái đã cập nhật thành công!']);
    }

    /**
     * Get all product sub categores
     */

     public function getSubCategories(Request $request)
     {
         $subCategories = SubCategory::where('category_id', $request->id)->get();

         return $subCategories;
     }

     public function getChildCategories(Request $request)
     {
         $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

         return $childCategories;
     }
}
