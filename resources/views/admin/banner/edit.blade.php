@extends('template.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h3 class="m-0 font-weight-bold text-primary text-align col">Sửa Banner</h3>
            <hr>
            <form action="{{ route('banner.update', ['banner'=>request()->route('banner')]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{$data->title}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" value="{{$data->image}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select form-select-lg" name="status" id="">
                        <option value="1" {{ $data->status == 1 ? 'selected' : ''}}>Hoạt Động</option>
                        <option value="0"  {{ $data->status == 0 ? 'selected' : ''}}>Không Hoạt Động</option>
                    
                    </select>
                </div>
                

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
