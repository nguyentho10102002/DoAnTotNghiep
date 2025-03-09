@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name}} || Quên mật khẩu
@endsection

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Quên mật khẩu</h4>
                        <ul>
                            <li><a href="#">Đăng nhập</a></li>
                            <li><a href="#">Quên mật khẩu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        FORGET PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>Bạn quên mật khẩu ?</h4>
                        <p>nhập địa chỉ email đã đăng ký với <span>e-shop</span></p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input id="email" type="email" name="email" value="{{old('email')}}" placeholder="Email của bạn">
                                </div>

                                <button class="common_btn" type="submit">Gửi</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{route('login')}}">Về trang đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        FORGET PASSWORD END
    ==============================-->
@endsection
