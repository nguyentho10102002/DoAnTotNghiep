@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Danh Mục Con</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập Nhật Danh Mục Con</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.child-category.update', $childCategory->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="inputState">Danh Mục</label>
                            <select id="inputState" class="form-control main-category" name="category">
                              <option value="">Chọn</option>
                              @foreach ($categories as $category)
                                <option {{$category->id == $childCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Danh Mục Con</label>
                            <select id="inputState" class="form-control sub-category" name="sub_category">
                              <option value="">Chọn</option>
                              @foreach ($subCategories as $subCategory)
                              <option {{$subCategory->id == $childCategory->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$childCategory->name}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng Thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$childCategory->status == 1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                              <option {{$childCategory->status == 0 ? 'selected' : ''}} value="0">Không kích hoạt</option>
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
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subcategories')}}",
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
        })
    </script>
@endpush
