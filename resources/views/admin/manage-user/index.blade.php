@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Quản lý Người Dùng</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo Người Dùng</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('admin.manage-user.create') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id="password" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role">Vai trò</label>
                            <select id="role" class="form-control" name="role" required>
                                <option value="">Chọn</option>
                                <option value="user">Người dùng</option>
                                <option value="vendor">Nhà cung cấp</option>
                                <option value="admin">Quản trị viên</option>
                            </select>
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
