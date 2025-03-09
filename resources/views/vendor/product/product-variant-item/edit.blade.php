@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Mục biến thể sản phẩm
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
            {{-- <a href="{{route('vendor.products-variant-item.index',
            ['productId' => $product->id, 'variantId' => $variant->id])}}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Quay lại</a> --}}
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Tạo mục biến thể</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant-item.update', $variantItem->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__input">
                        <label>Tên biến thể</label>
                        <input type="text" class="form-control" name="variant_name" value="{{$variantItem->productVariant->name}}" readonly>
                    </div>

                    <div class="form-group wsus__input">
                        <label>Tên mục</label>
                        <input type="text" class="form-control" name="name" value="{{$variantItem->name}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Giá <code>(Đặt 0 để làm miễn phí)</code></label>
                        <input type="text" class="form-control" name="price" value="{{$variantItem->price}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Mặc định</label>
                        <select id="inputState" class="form-control" name="is_default">
                            <option value="">Chọn</option>
                          <option {{$variantItem->is_default == 1 ? 'selected' : ''}} value="1">Có</option>
                          <option {{$variantItem->is_default == 0 ? 'selected' : ''}} value="0">Không</option>
                        </select>
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Trạng thái</label>
                        <select id="inputState" class="form-control" name="status">
                          <option {{$variantItem->status == 1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                          <option {{$variantItem->status == 0 ? 'selected' : ''}} value="0">Không kích hoạt</option>
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
