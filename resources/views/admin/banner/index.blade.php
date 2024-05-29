@extends('template.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="m-0 font-weight-bold text-primary col align-self-start d-flex">QUẢN LÝ BANNER</h6>
            <a href="{{ route('banner.create') }}" class="m-0 font-weight-bold btn btn-primary col-2 align-self-end"><i
                    class="fas fa-plus"></i></a>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $item->title }}</td>
                            <td><img src="{{ Storage::url($item->image) }}" alt="" width="100" height="100"></td>
                            <td style="{{$item->status == 1 ? 'color:green' : 'color: red'}}; font-weight: 900"><p class="d-flex justify-content-center">{{ $item->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</p></td>
                            <td>
                                <a href="{{ route('banner.edit', ['banner' => $item->id]) }}"
                                    class=""><i class="fas fa-edit"></i>
                                </a>
                                ||
                                <a href="{{ route('banner.delete', ['id' => $item->id]) }}"
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