@extends('template.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h3 class="m-0 font-weight-bold text-primary text-align col">THÊM DANH MỤC</h3>
            <hr>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" name="cate_name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
