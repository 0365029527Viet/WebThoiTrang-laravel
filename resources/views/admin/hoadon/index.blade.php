@extends('template.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary col align-self-start d-flex">QUẢN LÝ HÓA ĐƠN</h6>

            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày thanh toán</th>
                            <th>Tổng tiền</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $index++ }}</td>
                                @foreach ($item->user as $items)
                                    <td>{{ $items->name }}</td>
                                @endforeach
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <?php
                                $timeString = $item->time;
                                
                                $year = substr($timeString, 0, 4);
                                $month = substr($timeString, 4, 2);
                                $day = substr($timeString, 6, 2);
                                $hour = substr($timeString, 8, 2);
                                $minute = substr($timeString, 10, 2);
                                $second = substr($timeString, 12, 2);
                                
                                $dateTime = new DateTime("$year-$month-$day $hour:$minute:$second");
                                
                                $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
                                ?>
                                <td>{{ $formattedDateTime }}</td>
                                <td>{{ $item->total }}</td>
                                <td>
                                    <a href="{{ route('download', ['id'=>$item->id]) }}" class="d-flex justify-content-center"><i class="fas fa-file-pdf"></i>
                                    </a>

                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
                {{-- {{ $data->links() }} --}}
            </div>

        </div>
    </div>
@endsection
