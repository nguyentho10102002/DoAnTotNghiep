@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Cài đặt</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Thanh toán trực tuyến qua tài khoản Paypal</a>
                            <a class="list-group-item list-group-item-action" id="list-stripe-list" data-toggle="list" href="#list-stripe" role="tab">Thanh toán bằng thẻ tín dụng,thẻ ghi nợ</a>
                            <a class="list-group-item list-group-item-action" id="list-razorpay-list" data-toggle="list" href="#list-razorpay" role="tab">Thanh toán bằng ví điện tử RazorPay</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Thanh toán khi nhận hàng</a>
                          </div>
                        </div>
                        <div class="col-10">
                          <div class="tab-content" id="nav-tabContent">

                            @include('admin.payment-settings.sections.paypal-setting')

                            @include('admin.payment-settings.sections.stripe-setting')

                            @include('admin.payment-settings.sections.razorpay-setting')

                            @include('admin.payment-settings.sections.cod-setting')

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
        </section>

@endsection
