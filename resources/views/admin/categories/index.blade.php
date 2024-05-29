@extends('template.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="m-0 font-weight-bold text-primary col align-self-start d-flex">QUẢN LÝ DANH MUC</h6>
            <a href="{{ route('category.create') }}" class="m-0 font-weight-bold btn btn-primary col-2 align-self-end"><i
                    class="fas fa-plus"></i></a>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Cate_Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $item->cate_name }}</td>
                            <td>
                                <a href="{{ route('cate.edit', ['category' => $item->id]) }}"
                                    class=""><i class="fas fa-edit"></i>
                                </a>
                                ||
                                <a href="{{ route('cate.destroy', ['id' => $item->id]) }}"
                                    class=""><i class="fas fa-trash-alt"></i>
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