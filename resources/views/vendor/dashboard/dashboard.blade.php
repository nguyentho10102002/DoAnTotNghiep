@extends('vendor.layouts.master')
@section('title')
{{$settings->site_name}} || Bảng điều khiển
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>Đơn hàng hôm nay</p>
                    <h4 style="color:#ffff">{{$todaysOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Đơn hàng chờ xử lý hôm nay</p>
                      <h4 style="color:#ffff">{{$todaysPendingOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Tổng đơn hàng</p>
                      <h4 style="color:#ffff">{{$totalOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Tổng đơn hàng chờ xử lý</p>
                      <h4 style="color:#ffff">{{$totalPendingOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Đơn hàng đã hoàn thành</p>
                      <h4 style="color:#ffff">{{$totalCompleteOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.products.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Tổng sản phẩm</p>
                      <h4 style="color:#ffff">{{$totalProducts}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="javascript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Thu nhập hôm nay</p>
                      <h4 style="color:#ffff">{{$settings->currency_icon}}{{$todaysEarnings}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="javascript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Thu nhập trong tháng</p>
                      <h4 style="color:#ffff">{{$settings->currency_icon}}{{$monthEarnings}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="javascript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Thu nhập trong năm</p>
                      <h4 style="color:#ffff">{{$settings->currency_icon}}{{$yearEarnings}}</h4>
                    </a>
                </div>

                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="javascript:;">
                      <i class="fas fa-cart-plus"></i>
                      <p>Tổng thu nhập</p>
                      <h4 style="color:#ffff">{{$settings->currency_icon}}{{$toalEarnings}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.reviews.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Tổng đánh giá</p>
                      <h4 style="color:#ffff">{{$totalReviews}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.shop-profile.index')}}">
                      <i class="fas fa-user-shield"></i>
                      <p>Thông tin cửa hàng</p>
                      <h4 style="color:#ffff">-</h4>
                    </a>
                  </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
