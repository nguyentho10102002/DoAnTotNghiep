@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name}} || Trở Thành Nhà Cung Cấp Ngay Hôm Nay
@endsection

@section('content')
  <!--=============================
    DASHBOARD BẮT ĐẦU
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Yêu Cầu Nhà Cung Cấp</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {!!@$content->content!!}
              </div>
            </div>
            <br>
            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">
                    <form action="{{route('user.vendor-request.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="file" name="shop_image" placeholder="Ảnh Banner Cửa Hàng">
                        </div>
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" name="shop_name" placeholder="Tên Cửa Hàng">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <input type="text" name="shop_email" placeholder="Email Cửa Hàng">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <input type="text" name="shop_phone" placeholder="Số Điện Thoại Cửa Hàng">
                                </div>
                            </div>
                        </div>
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" name="shop_address" placeholder="Địa Chỉ Cửa Hàng">
                        </div>

                        <div class="wsus__dash_pro_single">
                            <textarea name="about" placeholder="Giới Thiệu Bạn"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Gửi</button>

                    </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD KẾT THÚC
  ==============================-->
@endsection
