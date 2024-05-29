@extends('template.client')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                @foreach ($item->product as $items)
                                    <td class="align-middle"><img src="{{ Storage::url($items->image) }}" alt=""
                                            style="width: 50px; height: 100px;">
                                        {{ $items->name }}</td>
                                    @php
                                        $price =
                                            ($items->price - $items->price * ($items->sale->discount / 100)) *
                                            $item->number;
                                    @endphp
                                    <td class="align-middle">{{ $price }}</td>
                                @endforeach
                                <td class="align-middle">
                                    {{ $item->number }}
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <input type="hidden" class="form-control form-control-sm bg-secondary text-center"
                                            value="{{ $item->number }}">

                                    </div>
                                </td>
                                <td class="align-middle">{{ $item->size }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('destroy.cart', ['id' => $item->id]) }}"><button
                                            class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">

                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thanh Toán</h4>
                    </div>
                    <form action="{{ route('payment') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Products</h5>
                            @foreach ($data as $item)
                               
                                <input type="hidden" name="size[]" value="{{ $item->size }}">
                                <input type="hidden" name="number[]" value="{{ $item->number }}">

                                @foreach ($item->product as $items)
                                <input type="hidden" name="product_id[]" value="{{ $items->name }}">
                                    <div class="d-flex justify-content-between">
                                        <p>{{ $items->name }}</p>
                                        <p>{{ $item->size }}</p>
                                        @php
                                            $price =
                                                ($items->price - $items->price * ($items->sale->discount / 100)) *
                                                $item->number;
                                            $total += $price;
                                        @endphp
                                        <p>{{ $price }}</p>

                                    </div>
                                    <input type="hidden" name="price[]" value="{{ $price }}">
                                @endforeach
                            @endforeach
                            <hr class="mt-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Tổng tiền</h6>
                                <h6 class="font-weight-medium">{{ $total }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">Free</h6>
                            </div>
                            <hr class="mt-0">
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <h6 class="font-weight-medium">Số điện thoại</h6>
                                <input type="number" class="form-control" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <h6 class="font-weight-medium">Địa chỉ</h6>
                                <textarea class="form-control" name="address" id="" placeholder="địa chỉ nhận hàng:" rows="3" required></textarea>
                            </div>



                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold">{{ $total }}K</h5>
                            </div>
                            <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
