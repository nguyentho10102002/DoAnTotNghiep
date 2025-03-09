@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Phương Thức Rút Tiền</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo Phương Thức</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.withdraw-method.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label>Số Tiền Tối Thiểu</label>
                            <input type="text" class="form-control" name="minimum_amount" value="">
                        </div>
                        <div class="form-group">
                            <label>Số Tiền Tối Đa</label>
                            <input type="text" class="form-control" name="maximum_amount" value="">
                        </div>
                        <div class="form-group">
                            <label>Phí Rút Tiền (%)</label>
                            <input type="text" class="form-control" name="withdraw_charge" value="">
                        </div>

                        <div class="form-group">
                            <label>Mô Tả</label>
                            <textarea name="description" class="summernote"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
