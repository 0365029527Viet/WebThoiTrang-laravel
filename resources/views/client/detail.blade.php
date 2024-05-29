@extends('template.client')
@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">SHOP DETAIL</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Detail</p>
            </div>
        </div>
    </div>

    <!-- Shop Detail Start -->
    @foreach ($data as $item)
        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            <div class="carousel-item active">
                                <img class="w-100" src="{{ Storage::url($item->image) }}" alt="Image" height="600">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold">{{ $item->name }}</h3>
                    <div class="d-flex mb-3">
                        <span>Category: {{ $item->category->cate_name }}</span>

                    </div>
                    
                        <em><del>₫{{ $item->price }}.000</del></em>
                        @php
                            $price = $item->price - ($item->sale->discount / 100) * $item->price;
                        @endphp
                        <h3 class="font-weight-semi-bold mb-4">₫{{ $price }}.000</h3>
                    <form action="{{route('cart')}}" method="post">
                        @csrf
                        {{-- {{Auth::user() ? Auth::user()->id : '0'}} --}}
                        <input type="hidden" name="user_id" value="{{Auth::user() ? Auth::user()->id : '0'}}">
                        <input type="hidden" name="product_id" value="{{$item->id}}">
                        <div class="d-flex mb-3">
                            <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                            @php
                                $size = explode(',', $item->size);
                                $index = 1;
                            @endphp

                            <div>
                                @foreach ($size as $sizes)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="size-{{ $index }}"
                                            name="size" value="{{ $sizes }}" required>
                                        <label class="custom-control-label"
                                            for="size-{{ $index }}">{{ $sizes }}</label>
                                    </div>
                                    @php
                                        $index++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    {{-- <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button> --}}
                                </div>
                                <input type="number" class="form-control bg-secondary text-center"
                                    placeholder="số lượng : 1" name="number" min="1" max="{{ $item->number }}" value="1">
                                <div class="input-group-btn">
                                    {{-- <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button> --}}
                                </div>
                            </div>
                            <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>
                                    Add
                                    To Cart</button>
                        </div>
                    </form>
                    <div class="d-flex pt-2">
                        <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="container-fluid pt-5">
                        <div class="row px-xl-5 pb-3">
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="d-flex align-items-center border mb-4">
                                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                                    <h6 class="">Quality Product</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="d-flex align-items-center border mb-4">
                                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                                    <h6 class="">Free Shipping</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="d-flex align-items-center border mb-4">
                                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                                    <h6 class="">14-Day Return</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="d-flex align-items-center border mb-4">
                                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                                    <h6 class="">24/7 Support</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{!! $item->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Shop Detail End -->


    <!-- Products Start -->

    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($similar as $item)
                        <div class="card product-item border-0">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid" src="{{ Storage::url($item->image) }}" alt=""
                                    style="height: 300px; width: 100%;">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $item->name }}</h6>
                                @php
                                    $price = $item->price - ($item->sale->discount / 100) * $item->price;
                                @endphp
                                <div class="d-flex justify-content-center">
                                    <h6>₫{{ $price }}.000</h6>
                                    <h6 class="text-muted ml-2"><del>₫{{ $item->price }}.000</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ route('client.detail', ['id' => $item->id]) }}"
                                    class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                    Detail</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!-- Products End -->
@endsection
