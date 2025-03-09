@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Phương thức rút tiền</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập nhật phương thức</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.withdraw-method.update', $method->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $method->name }}">
                        </div>
                        <div class="form-group">
                            <label>Số tiền tối thiểu</label>
                            <input type="text" class="form-control" name="minimum_amount" value="{{ $method->minimum_amount }}">
                        </div>
                        <div class="form-group">
                            <label>Số tiền tối đa</label>
                            <input type="text" class="form-control" name="maximum_amount" value="{{ $method->maximum_amount }}">
                        </div>
                        <div class="form-group">
                            <label>Phí rút tiền (%)</label>
                            <input type="text" class="form-control" name="withdraw_charge" value="{{ $method->withdraw_charge }}">
                        </div>

                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" class="summernote">{!! $method->description !!}</textarea>
                        </div>

                        <button type="submmit" class="btn btn-primary">Cập nhật</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
