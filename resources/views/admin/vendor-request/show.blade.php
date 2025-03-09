@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Yêu cầu người bán</h1>
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                          <td>Tên người dùng: </td>
                          <td>{{$vendor->user->name}}</td>
                        </tr>
                        <tr>
                            <td>Email người dùng: </td>
                            <td>{{$vendor->user->email}}</td>
                        </tr>
                        <tr>
                            <td>Tên cửa hàng: </td>
                            <td>{{$vendor->shop_name}}</td>
                        </tr>
                        <tr>
                            <td>Email cửa hàng: </td>
                            <td>{{$vendor->email}}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoại cửa hàng: </td>
                            <td>{{$vendor->phone}}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ cửa hàng: </td>
                            <td>{{$vendor->address}}</td>
                        </tr>
                        <tr>
                            <td>Mô tả: </td>
                            <td>{{$vendor->description}}</td>
                        </tr>
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="col-md-4">
                            <form action="{{route('admin.vendor-requests.change-status', $vendor->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Hành động</label>
                                    <select name="status" class="form-control" >
                                        <option {{$vendor->status == 0 ? 'selected': ''}} value="0">Chờ duyệt</option>
                                        <option {{$vendor->status == 1 ? 'selected': ''}} value="1">Duyệt</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary"> Cập nhật</button>
                            </form>
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

@push('scripts')
    <script>
        $(document).ready(function(){

            $('#order_status').on('change', function(){
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.order.status')}}",
                    data: {status: status, id:id},
                    success: function(data){
                        if(data.status === 'success'){
                            toastr.success(data.message)
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            })

            $('#payment_status').on('change', function(){
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.payment.status')}}",
                    data: {status: status, id:id},
                    success: function(data){
                        if(data.status === 'success'){
                            toastr.success(data.message)
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            })

            $('.print_invoice').on('click', function(){
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());

                window.print();

                $('body').html(originalContents);

            })
        })
    </script>
@endpush
