@extends('template.client')
@section('content')
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    h3 {
        color: #333;
    }

    .table-responsive {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        color: #333;
        /* display: block; */
    }

    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    textarea {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        resize: none;
    }

    #charCount {
        color: #888;
        font-size: 12px;
        margin-top: 5px;
    }

    h4 {
        color: #333;
    }

    h5 {
        color: #555;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">PayMent</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">PayMent</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container">
        <h3>Thông tin chuyển khoản đơn hàng</h3>
        <div class="table-responsive">
            <form action="{{ route('create.vnpay') }}" id="frmCreateOrder" method="post">
                @csrf
                <div class="form-group">
                    <label for="amount">Số tiền</label>
                    <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="money" type="number" value="{{$payment['total']}}" readonly/>
                </div>
                <div class="form-group">
                    <label for="amount">Email</label><br>
                    <div style="font-size: 10px; color: red;">Anh chị vui lòng nhập đúng địa chỉ email, nếu sai sảy ra lỗi chúng em sẽ không chịu trách nhiệm cho trường hợp này.</div>
                    <input class="form-control" name="email" type="text" value="{{Auth::user()->email}}"/>
                </div>
                <h4>Chọn phương thức thanh toán</h4>
                <div class="form-group">
                    

                    <input type="radio" id="bankCode" name="bankCode" value="VNBANK" checked>
                    <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>

                </div>
                <div class="form-group">
                    <input type="hidden" id="language" Checked="True" name="language" value="vn">

                </div>
                <button type="submit" class="btn btn-default" href>Xác nhận thanh toán</button>
            </form>
        </div>
    </div>
    <script>
        function checkLength(textarea) {
            const maxLength = parseInt(textarea.getAttribute("maxlength"));
            const currentLength = textarea.value.length;
            const charCountElement = document.getElementById("charCount");

            if (currentLength <= maxLength) {
                charCountElement.textContent = `${currentLength}/${maxLength} ký tự`;
            } else {
                charCountElement.textContent = `Đã vượt quá giới hạn (${currentLength}/${maxLength} ký tự)`;
            }
        }
    </script>
@endsection