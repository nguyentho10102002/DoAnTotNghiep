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
                  <h4>Tiêu đề Footer Grid Hai</h4>
                </div>
                <div class="card-body">
                  <form action="{{route('admin.footer-grid-two.change-title')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-4">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" name="title" value="{{@$footerTitle->footer_grid_two_title}}">
                            <button type="submit" class="btn btn-primary ml-4">Lưu</button>
                        </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      </section>

        <section class="section">

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Footer Grid Hai</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.footer-grid-two.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tạo mới</a>
                    </div>
                  </div>
                  <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.footer-grid-two.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush
