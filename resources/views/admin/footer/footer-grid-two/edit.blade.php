@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Chân trang</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Chỉnh sửa mục chân trang</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.footer-grid-two.update', $footer->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$footer->name}}">
                        </div>

                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" class="form-control" name="url" value="{{$footer->url}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$footer->status === 1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                              <option {{$footer->status === 0 ? 'selected' : ''}} value="0">Không kích hoạt</option>
                            </select>
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
