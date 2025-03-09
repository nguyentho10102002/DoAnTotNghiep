@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Sản phẩm
@endsection

@section('content')
  <!--=============================
    BẢNG ĐIỀU KHIỂN BẮT ĐẦU
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Tạo sản phẩm</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div id="imageContainer" class="col-md-12">
                             <div class="form-group wsus__input">
                                 <label>Ảnh</label>
                                 <input type="file" class="form-control" name="image" id="fileInput">
                             </div>
                             <p id="resultMessage"></p>
                         </div>

                         <div id="previewContainer" class="col-md-4 hidden">
                                   <img  src="" id="preview_img" width="100px" width="100px" style="object-fit: cover;" >
                             </div>
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
                                 fetch("{{ route('vendor.check.brand') }}", {
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

                    <div class="form-group wsus__input">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">Danh mục</label>
                                <select id="inputState" class="form-control main-category" name="category">
                                  <option value="">Chọn</option>
                                  @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">Danh mục con</label>
                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                    <option value="">Chọn</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">Danh mục con nữa</label>
                                <select id="inputState" class="form-control child-category" name="child_category">
                                    <option value="">Chọn</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Thương hiệu</label>
                        <select id="inputState-2" class="form-control" name="brand">
                            <option value="">Chọn</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group wsus__input">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Giá</label>
                        <input type="text" class="form-control" name="price" value="{{old('price')}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Giá ưu đãi</label>
                        <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group wsus__input">
                                <label>Ngày bắt đầu ưu đãi</label>
                                <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group wsus__input">
                                <label>Ngày kết thúc ưu đãi</label>
                                <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group wsus__input">
                        <label>Số lượng tồn kho</label>
                        <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Liên kết video</label>
                        <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Mô tả ngắn</label>
                        <textarea name="short_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group wsus__input">
                        <label>Mô tả dài</label>
                        <textarea name="long_description" class="form-control summernote"></textarea>
                    </div>

                    <div class="form-group wsus__input">
                        <label>Tiêu đề SEO</label>
                        <input type="text" class="form-control" name="seo_title" value="{{old('seo_title')}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Mô tả SEO</label>
                        <textarea name="seo_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Trạng thái</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="1">Hoạt động</option>
                          <option value="0">Không hoạt động</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    BẢNG ĐIỀU KHIỂN KẾT THÚC
  ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('vendor.product.get-subcategories')}}",
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


            /** get child categories **/
            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('vendor.product.get-child-categories')}}",
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
