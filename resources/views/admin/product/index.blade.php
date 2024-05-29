@extends('template.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="m-0 font-weight-bold text-primary col align-self-start d-flex">QUẢN LÝ SẢN PHẨM</h6>
            <a href="{{ route('product.create') }}" class="m-0 font-weight-bold btn btn-primary col-2 align-self-end"><i
                    class="fas fa-plus"></i></a>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Number</th>
                        <th>Status</th>
                        <th>Danh mục</th>
                        <th>Khuyến mãi</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td><img src="{{ Storage::url($item->image) }}" alt="" width="100" height="100"></td>
                            
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->category->cate_name }}</td>
                            <td>{{ $item->sale->title }}</td>
                            <td class="text-truncate" style="max-width: 190px; max-height: 150px;">{{ $item->description }}</td>
                            <td>
                                <a href="{{ route('product.edit', ['product' => $item->id]) }}"
                                    class="d-flex justify-content-center"><i class="fas fa-edit"></i>
                                </a>
                                <hr style="background-color: black; height: 10px;;">
                                <a href="{{ route('product.delete', ['id' => $item->id]) }}"
                                    class="d-flex justify-content-center"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $data->links() }}
        </div>
        
    </div>
</div>
@endsection