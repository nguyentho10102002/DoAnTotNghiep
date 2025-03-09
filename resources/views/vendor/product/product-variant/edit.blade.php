@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Biến thể sản phẩm
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
            <a href="{{route('vendor.products-variant.index', ['product' => $variant->product_id])}}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Quay lại</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Cập nhật biến thể</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant.update', $variant->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__input">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="name" value="{{$variant->name}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Trạng thái</label>
                        <select id="inputState" class="form-control" name="status">
                          <option {{$variant->status == 1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                          <option {{$variant->status == 0 ? 'selected' : ''}} value="0">Không kích hoạt</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
