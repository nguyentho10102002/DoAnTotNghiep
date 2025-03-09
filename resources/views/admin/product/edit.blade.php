@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Sản phẩm</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập nhật sản phẩm</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group wsus__input">
                            <label>Hình ảnh xem trước</label>
                            <br>
                            <img src="{{asset($product->thumb_image)}}" style="width:200px" alt="">
                        </div>
                        </div>
                         <div class="col-md-6">
                        <div class="form-group wsus__input">

                            <br>
                            <img src="" id="preview_img" style="width:200px" alt="">
                        </div>
                        </div>
                        </div>
                        <div class="form-group wsus__input">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" id="fileInput" name="image">
                             <p id="resultMessage"></p>
                        </div>

                        <div class="form-group wsus__input">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        </div>

                           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const fileInput = document.getElementById('fileInput');
                        const resultMessage = document.getElementById('resultMessage'); // Thông báo kết quả
                        const imageContainer = document.getElementById('imageContainer');
                        const previewContainer = document.getElementById('previewContainer');
                        const previewImg = document.getElementById('preview_img');
                        const brandSelect = document.getElementById('inputState-2'); // Thương hiệu dropdown

                        fileInput.addEventListener('change', function () {
                            const formData = new FormData();
                            const file = fileInput.files[0];

                            if (file) {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    previewImg.src = e.target.result;
                                    previewImg.classList.remove('hidden');
                                    imageContainer.className = 'col-md-8';
                                    previewContainer.classList.remove('hidden');
                                };

                                reader.readAsDataURL(file);
                                formData.append('image', file);

                                // Gửi yêu cầu AJAX tới route Laravel để gọi API dự đoán
                                fetch("{{ route('admin.check.brand') }}", {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.predictions) {
                                        console.log('Dự đoán từ API:', data.predictions);

                                        const firstPrediction = data.predictions[0]?.label || '';
                                        resultMessage.innerText = `Dự đoán: ${firstPrediction}`;

                                        // Tự động chọn thương hiệu dựa trên dự đoán
                                        const options = brandSelect.querySelectorAll('option');
                                        let found = false;

                                        options.forEach(option => {
                                            if (option.textContent.toLowerCase() == firstPrediction.toLowerCase()) {
                                                option.selected = true;
                                                found = true;
                                            }
                                        });

                                        // Nếu không tìm thấy thương hiệu, chọn mặc định
                                        if (!found) {
                                            resultMessage.innerText += ' - Không tìm thấy thương hiệu trong danh sách.';
                                        }
                                    } else {
                                        resultMessage.innerText = 'Không có dự đoán nào từ API.';
                                    }
                                })
                                .catch(error => {
                                    console.error('Lỗi:', error);
                                    resultMessage.innerText = 'Có lỗi xảy ra khi gọi API.';
                                });
                            } else {
                                previewImg.src = '';
                                previewImg.classList.add('hidden');
                                imageContainer.className = 'col-md-12';
                                previewContainer.classList.add('hidden');
                                resultMessage.innerText = 'Vui lòng chọn hình ảnh.';
                            }
                        });
                    });

                </script>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Danh mục</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                      <option value="">Chọn</option>
                                      @foreach ($categories as $category)
                                        <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Danh mục phụ</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category">
                                        <option value="">Chọn</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option {{$subCategory->id == $product->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Danh mục con</label>
                                    <select id="inputState" class="form-control child-category" name="child_category">
                                        <option value="">Chọn</option>
                                        @foreach ($childCategories as $childCategory)
                                            <option {{$childCategory->id == $product->child_category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputState">Thương hiệu</label>
                            <select id="inputState-2" class="form-control" name="brand">
                                <option value="">Chọn</option>
                                @foreach ($brands as $brand)
                                    <option {{$brand->id == $product->brand_id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                        </div>

                        <div class="form-group">
                            <label>Giá</label>
                            <input type="text" class="form-control" name="price" value="{{$product->price}}">
                        </div>

                        <div class="form-group">
                            <label>Giá ưu đãi</label>
                            <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày bắt đầu ưu đãi</label>
                                    <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$product->offer_start_date}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày kết thúc ưu đãi</label>
                                    <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$product->offer_end_date}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Số lượng trong kho</label>
                            <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}">
                        </div>

                        <div class="form-group">
                            <label>Link video</label>
                            <input type="text" class="form-control" name="video_link" value="{{$product->video_link}}">
                        </div>

                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <textarea name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Mô tả chi tiết</label>
                            <textarea name="long_description" class="form-control summernote">{!! $product->long_description !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Loại sản phẩm</label>
                            <select id="inputState" class="form-control" name="product_type">
                                <option value="">Chọn</option>
                                <option {{$product->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">Sản phẩm mới</option>
                                <option {{$product->product_type == 'featured_product' ? 'selected' : ''}} value="featured_product">Sản phẩm nổi bật</option>
                                <option {{$product->product_type == 'top_product' ? 'selected' : ''}} value="top_product">Sản phẩm bán chạy</option>
                                <option {{$product->product_type == 'best_product' ? 'selected' : ''}} value="best_product">Sản phẩm tốt nhất</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tiêu đề Seo</label>
                            <input type="text" class="form-control" name="seo_title" value="{{$product->seo_title}}">
                        </div>

                        <div class="form-group">
                            <label>Mô tả Seo</label>
                            <textarea name="seo_description" class="form-control">{!!$product->seo_description!!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$product->status == 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                              <option {{$product->status == 0 ? 'selected' : ''}} value="0">Không hoạt động</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Cập nhật</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){

                $('.child-category').html('<option value="">Chọn</option>')

                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Chọn</option>')

                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })


            /** lấy danh mục con **/
            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-child-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.child-category').html('<option value="">Chọn</option>')

                        $.each(data, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
