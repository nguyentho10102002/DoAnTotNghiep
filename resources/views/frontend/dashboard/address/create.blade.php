@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>Tạo địa chỉ</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{route('user.address.store')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Tên <b>*</b></label>
                      <input type="text" placeholder="Nhập tên" name="name">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Email</label>
                      <input type="email" placeholder="Nhập email" name="email">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Số điện thoại <b>*</b></label>
                      <input type="text" placeholder="Nhập số điện thoại" name="phone">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Quốc gia <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2" name="country">
                          <option>Chọn</option>
                            @foreach (config('settings.country_list') as $country)
                                <option value="{{$country}}">{{$country}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Tiểu bang <b>*</b></label>
                      <input type="text" placeholder="Nhập tiểu bang" name="state">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Thành phố <b>*</b></label>
                      <input type="text" placeholder="Nhập thành phố" name="city">
                    </div>
                  </div>


                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Mã bưu chính <b>*</b></label>
                      <input type="text" placeholder="Nhập mã bưu chính" name="zip">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Địa chỉ <b>*</b></label>
                      <input type="text" placeholder="Nhập địa chỉ" name="address">
                    </div>
                  </div>


                  <div class="col-xl-6">
                    <button type="submit" class="common_btn">Tạo mới</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
