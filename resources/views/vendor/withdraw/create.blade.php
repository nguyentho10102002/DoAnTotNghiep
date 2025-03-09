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
            <h3><i class="far fa-user"></i> Tạo yêu cầu rút tiền</h3>
            <div class="wsus__dashboard_profile">
              <div class="row">
                <div class="wsus__dash_pro_area col-md-6">

                    <form action="{{route('vendor.withdraw.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group wsus__input">
                            <label>Phương thức</label>
                            <select name="method" id="method" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($methods as $method)
                                <option value="{{ $method->id }}">{{$method->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group wsus__input">
                            <label>Số tiền rút</label>
                            <input type="text" class="form-control" name="amount">
                        </div>

                        <div class="form-group wsus__input">
                            <label>Thông tin tài khoản</label>
                            <textarea name="account_info" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </form>

                  </div>

                  <div class="wsus__dash_pro_area col-md-6 account_info_area ml-2">


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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#method').on('change', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.withdraw.show', ':id') }}".replace(':id', id),
                    success: function(response){
                        $('.account_info_area').html(`
                    <h3>Khoảng thanh toán: {{ $settings->currency_icon }}${response.minimum_amount} - {{ $settings->currency_icon }}${response.maximum_amount}</h3>
                    <h3>Phí rút tiền: ${response.withdraw_charge}%</h3>
                    <p>${response.description}</p>`)
                    },
                    error: function(error){
                        console.log(error);
                    }
                })
            });
        })
    </script>
@endpush
