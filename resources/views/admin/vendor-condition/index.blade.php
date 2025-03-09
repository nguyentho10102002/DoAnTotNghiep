@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Điều kiện nhà cung cấp</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Điều kiện nhà cung cấp</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.vendor-condition.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="content" class="summernote">{!!@$content->content!!}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
