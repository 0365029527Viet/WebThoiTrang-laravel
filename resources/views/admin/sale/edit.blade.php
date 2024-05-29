@extends('template.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">

        <h3 class="m-0 font-weight-bold text-primary text-align col">SỬA KHUYẾN MÃI</h3>
        <hr>
        <form action="{{ route('sale.update',['sale'=>request()->route('sale')]) }}" method="post">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{$data->title}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Discount</label>
                <input type="text" class="form-control" name="discount" value="{{$data->discount}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>

@endsection