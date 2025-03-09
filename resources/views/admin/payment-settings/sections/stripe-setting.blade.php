<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.stripe-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Trạng thái Stripe</label>
                    <select name="status" id="" class="form-control">
                        <option {{$stripeSetting->status === 1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                        <option {{$stripeSetting->status === 0 ? 'selected' : ''}} value="0">Tắt</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Chế độ Tài khoản</label>
                    <select name="mode" id="" class="form-control">
                        <option {{$stripeSetting->mode === 0 ? 'selected' : ''}} value="0">Môi trường kiểm thử</option>
                        <option {{$stripeSetting->mode === 1 ? 'selected' : ''}} value="1">Môi trường thực tế</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tên Quốc gia</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Chọn</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{$country === $stripeSetting->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tên Tiền Tệ</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Chọn</option>
                        @foreach (config('settings.currecy_list') as $key => $currency)
                            <option {{$currency === $stripeSetting->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tỷ giá tiền tệ (Tính theo {{$settings->currency_name}})</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{$stripeSetting->currency_rate}}">
                </div>
                <div class="form-group">
                    <label>ID khách hàng Stripe</label>
                    <input type="text" class="form-control" name="client_id" value="{{$stripeSetting->client_id}}">
                </div>
                <div class="form-group">
                    <label>Khóa bí mật Stripe</label>
                    <input type="text" class="form-control" name="secret_key" value="{{$stripeSetting->secret_key}}">
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
