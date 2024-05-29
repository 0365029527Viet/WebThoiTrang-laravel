<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\sendMail;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\paymentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class paymentCtrl extends Controller
{
    public function payment(Request $request)
    {
        // dd($request->all());
        $orderDetail = [];
        for ($i = 0; $i < count($request->product_id); $i++) {
            $orderDetail[] = [
                'product_id' => $request->product_id[$i],
                'size' => $request->size[$i],
                'number' => $request->number[$i],
                'price' => $request->price[$i],
                // 'product_id' => $request->product_id[$i],
            ];
        }
        $request->session()->put('orderDetail', $orderDetail);

        $payment = [
            'total' => $request->total,
            'user_id' => $request->user_id,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        // dd($payment);
        $request->session()->put('payment', $payment);
        return view('client.payment.index', compact('payment'));
    }
    public function create_vnpay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('return.vnpay');
        $vnp_TmnCode = "TTVOYSZW"; //Mã website tại VNPAY
        $vnp_HashSecret = "DHWPAHJHGIHXDUCOQWAOJSDMOBMIIUNW"; //Chuỗi bí mật
        $vnp_TxnRef = rand(1, 10000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo =  $_POST['email'];
        $vnp_OrderType = "MUA HANG";
        $vnp_Amount = $_POST['money'] * 100000;
        $vnp_Locale =  $_POST['language'];
        $vnp_BankCode = $_POST['bankCode'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //127.0.0.1

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            // "vnp_Email" => $vnp_Email,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        // dd($inputData);
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        // var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        // dd($vnp_Url);
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        // dd($vnp_Url);
        header('Location: ' . $vnp_Url);
        // dd(header('Location: ' . $vnp_Url));
        die();
    }

    public function return(Request $request)
    {
        // dd($request->all());
        $vnp_HashSecret = "DHWPAHJHGIHXDUCOQWAOJSDMOBMIIUNW";
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = $request->all();

        // dd($inputData);
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $payment = $request->session()->get('payment');
                $payment['time'] = $inputData['vnp_PayDate'];
                $id = Payment::create($payment);
                if($id) {
                    $paymentID = $id->id;
                    $orderDetail = session('orderDetail');
                    foreach ($orderDetail as $value) {
                        $value['payment_id'] = $paymentID;
                        $ok = paymentDetail::create($value);
                        
                    }
                    if($ok){
                        Cart::where('user_id', $id->user_id)->delete();
                        $user = User::where('id', $id->user_id)->first();
                        $payment = Payment::where('id', $paymentID)->first();
                        $product = paymentDetail::where('payment_id', $paymentID)->get();
                        Mail::to($inputData['vnp_OrderInfo'])->queue(new sendMail($payment,$inputData, $product, $user));
                    }
                }
                $request->session()->forget('payment');
                $request->session()->forget('orderDetail');
                return redirect()->route('client.trangchu')->with('success', 'Thanh toan thanh cong');
            }
        }
    }
}
