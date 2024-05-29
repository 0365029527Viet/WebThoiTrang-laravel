@extends('template.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">

        <h3 class="m-0 font-weight-bold text-primary text-align col">Sửa Banner</h3>
        <hr>
        <form action="{{ route('product.update', ['product'=>request()->route('product')]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="" class="form-label">Danh mục</label>

                <select class="form-select form-select-lg" name="cate_id" id="">
                    @foreach ($cate as $item)
                        <option value="{{ $item->id }}" {{$data->cate_id == $item->id ? 'selected' : ''}}>{{ $item->cate_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tên</label>
                <input type="text" class="form-control" name="name" value="{{$data->name}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Giá</label>
                <input type="text" class="form-control" name="price" value="{{$data->price}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" value="{{$data->image}}">
            </div>



            <div class="mb-3">
                <label for="" class="form-label">Size</label>
                <input type="text" class="form-control" id="selectedSize" disabled value="{{$data->size}}">
                <select class="form-select form-select-lg" name="size[]" id="sizeSelect" multiple>
                    {{-- @foreach ($data as $item) --}}
                        
                        @php
                            $size = explode(',',$data->size);
                            // echo $size;
                            // die();
                        @endphp
                    <option value="S" {{ in_array('S',$size) ? 'selected' :''}}>Small (S)</option>
                    <option value="M" {{ in_array('S',$size) ? 'selected' :''}}>Medium (M)</option>
                    <option value="L" {{ in_array('S',$size) ? 'selected' :''}}>Large (L)</option>
                    <option value="XL" {{ in_array('S',$size) ? 'selected' :''}}>Extra Large (XL)</option>
                    {{-- @endforeach --}}
                </select>
                
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <select class="form-select form-select-lg" name="status" id="">
                    <option value="New" {{$data->status === 'New' ? 'selected' : ''}}>New</option>
                    <option value="Hot" {{$data->status === 'Hot' ? 'selected' : ''}}>Hot</option>

                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="number" value="{{$data->number}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Khuyến mãi</label>

                <select class="form-select form-select-lg" name="sale_id" id="">
                    @foreach ($sale as $item)
                        <option value="{{ $item->id }}" {{$data->sale_id == $item->id ? 'selected' : ''}}>{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Mô tả</label>
                <textarea class="form-control" name="description" id="" rows="15" value="{{ $data->description }}">{{ $data->description }}</textarea>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("sizeSelect").addEventListener("change", function() {
            var selectedOptions = [];
            var options = this.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].selected) {
                    selectedOptions.push(options[i].value);
                }
            }
            document.getElementById("selectedSize").value = selectedOptions.join(", ");
        });
    });
</script>

@endsection