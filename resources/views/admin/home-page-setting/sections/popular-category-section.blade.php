@php
    $popularCategorySection = json_decode($popularCategorySection->value);
@endphp

<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.popular-category-section')}}" method="POST">
                @csrf
                @method('PUT')
                <h5>Danh mục 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="cat_one" class="form-control main-category">
                                <option value="">Chọn</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $popularCategorySection[0]->category ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                             $subCategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[0]->category)->get();
                            @endphp
                            <label>Danh mục con</label>
                            <select name="sub_cat_one" id="" class="form-control sub-category">
                                <option value="">Chọn</option>
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $popularCategorySection[0]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $childCategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[0]->sub_category)->get();
                            @endphp
                            <label>Danh mục cháu</label>
                            <select name="child_cat_one" id="" class="form-control child-category">
                                <option value="">Chọn</option>
                                @foreach ($childCategories as $childCategory)
                                    <option {{$childCategory->id == $popularCategorySection[0]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h5>Danh mục 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="cat_two" id="" class="form-control main-category">
                                <option value="">Chọn</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $popularCategorySection[1]->category ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $subCategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[1]->category)->get();
                           @endphp
                            <label>Danh mục con</label>
                            <select name="sub_cat_two" id="" class="form-control sub-category">
                                <option value="">Chọn</option>
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $popularCategorySection[1]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $childCategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[1]->sub_category)->get();
                            @endphp
                            <label>Danh mục cháu</label>
                            <select name="child_cat_two" id="" class="form-control child-category">
                                <option value="">Chọn</option>
                                @foreach ($childCategories as $childCategory)
                                <option {{$childCategory->id == $popularCategorySection[1]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tiếp tục chỉnh sửa tương tự cho danh mục 3 và danh mục 4 -->
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.sub-category');
                        selector.html('<option value="">Chọn</option>')

                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            /** Lấy danh mục cháu **/
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.child-category');
                        selector.html('<option value="">Chọn</option>')

                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
