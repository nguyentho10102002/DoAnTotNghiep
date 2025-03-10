@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bảng điều khiển</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.order.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng hôm nay</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.pending-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đang chờ hôm nay</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysPendingOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.order.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.pending-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng đang chờ</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPendingOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.canceled-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng đã hủy</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCanceledOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.delivered-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng hoàn thành</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCompleteOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu hôm nay</h4>
                            </div>
                            <div class="card-body">
                                {{$settings->currency_icon}}{{ $todaysEarnings }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu tháng này</h4>
                            </div>
                            <div class="card-body">
                                {{$settings->currency_icon}}{{ $monthEarnings }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu năm nay</h4>
                            </div>
                            <div class="card-body">
                                {{$settings->currency_icon}}{{ $yearEarnings }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.reviews.index')}}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đánh giá</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalReview }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.brand.index')}}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-copyright"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số thương hiệu</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBrands }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.category.index')}}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số danh mục</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCategories }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <a href="{{route('admin.blog.index')}}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tổng số bài viết</h4>
                        </div>
                        <div class="card-body">
                            {{$totalBlogs}}
                        </div>
                    </div>
                </div>
            </a>
            </div>

            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.subscribers.index')}}">
                 <div class="card card-statistic-1">
                     <div class="card-icon bg-warning">
                         <i class="far fa-file"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Tổng số người đăng ký</h4>
                         </div>
                         <div class="card-body">
                             {{$totalSubscriber}}
                         </div>
                     </div>
                 </div>
             </a>
             </div>

             <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.vendor-list.index')}}">
                 <div class="card card-statistic-1">
                     <div class="card-icon bg-warning">
                         <i class="far fa-file"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Tổng số nhà cung cấp</h4>
                         </div>
                         <div class="card-body">
                             {{$totalVendors}}
                         </div>
                     </div>
                 </div>
             </a>
             </div>

             <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.customer.index')}}">
                 <div class="card card-statistic-1">
                     <div class="card-icon bg-warning">
                         <i class="far fa-file"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Tổng số người dùng</h4>
                         </div>
                         <div class="card-body">
                             {{$totalUsers}}
                         </div>
                     </div>
                 </div>
             </a>
             </div>

        </div>

    </section>
@endsection
