@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Tạo yêu cầu rút tiền
@endsection

@section('content')
  <!--=============================
    DASHBOARD BẮT ĐẦU
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Yêu cầu rút tiền</h3>
            <div class="wsus__dashboard_profile">
              <div class="row">
                <div class="wsus__dash_pro_area col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Phương thức rút tiền</b></td>
                                <td>{{ $request->method }}</td>
                            </tr>
                            <tr>
                                <td><b>Phí rút tiền</b></td>
                                <td>{{ ($request->withdraw_charge / $request->total_amount) * 100 }} %</td>
                            </tr>

                            <tr>
                                <td><b>Số tiền phí rút</b></td>
                                <td>{{ $settings->currency_icon }} {{ $request->withdraw_charge }}</td>
                            </tr>
                            <tr>
                                <td><b>Tổng số tiền</b></td>
                                <td>{{ $settings->currency_icon }} {{ $request->total_amount }}</td>
                            </tr>
                            <tr>
                                <td><b>Số tiền rút</b></td>
                                <td>{{ $settings->currency_icon }} {{ $request->withdraw_amount }}</td>
                            </tr>
                            <tr>
                                <td><b>Trạng thái</b></td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                    @elseif($request->status == 'paid')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                    @else
                                    <span class="badge bg-danger">Từ chối</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Thông tin tài khoản</b></td>
                                <td>{!! $request->account_info !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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
