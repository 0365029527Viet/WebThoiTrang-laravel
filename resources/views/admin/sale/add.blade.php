@extends('template.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h3 class="m-0 font-weight-bold text-primary text-align col">THÊM DANH MỤC</h3>
            <hr>
            <form action="{{ route('sale.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Discount</label>
                    <input type="number" class="form-control" name="discount">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
