@extends('admin.layouts.master')

@section('content')
      <!-- Nội dung chính -->
        <section class="section">
          <div class="section-header">
            <h1>Quy tắc Giao hàng</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập nhật Quy tắc Giao hàng</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.shipping-rule.update', $shipping->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$shipping->name}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Loại</label>
                            <select id="" class="form-control shipping-type" name="type">
                              <option {{$shipping->type === 'flat_cost' ? 'selected' : ''}} value="flat_cost">Chi phí cố định</option>
                              <option {{$shipping->type === 'min_cost' ? 'selected' : ''}} value="min_cost">Số tiền đơn hàng tối thiểu</option>
                            </select>
                        </div>

                        <div class="form-group min_cost {{$shipping->type === 'min_cost' ? '' : 'd-none'}}">
                            <label>Số tiền tối thiểu</label>
                            <input type="text" class="form-control" name="min_cost" value="{{$shipping->min_cost}}">
                        </div>

                        <div class="form-group">
                            <label>Chi phí</label>
                            <input type="text" class="form-control" name="cost" value="{{$shipping->cost}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$shipping->status === 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                              <option {{$shipping->status === 0 ? 'selected' : ''}} value="0">Không hoạt động</option>
                            </select>
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

@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change', '.shipping-type', function(){
            let value = $(this).val();

            if(value != 'min_cost'){
                $('.min_cost').addClass('d-none')
            }else {
                $('.min_cost').removeClass('d-none')
            }
        })
    })
</script>
@endpush
