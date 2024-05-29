@extends('template.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h3 class="m-0 font-weight-bold text-primary text-align col">THÊM Banner</h3>
            <hr>
            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select form-select-lg" name="status" id="">
                        <option value="1">Hoạt Động</option>
                        <option value="0">Không Hoạt Động</option>
                    
                    </select>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
