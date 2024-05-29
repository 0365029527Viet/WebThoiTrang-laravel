<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\paymentDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class donHangCtrl extends Controller
{
    public function index()
    {
        $data = Payment::with('user')->get();
        // dd($data);
        // foreach ($data as $value) {
        //     foreach ($value->user as $values) {
        //         dd($values);
        //     }
        // }
        return view('admin.hoadon.index', compact('data'));
    }
    public function download($id)
    {
        $date = Carbon::now()->addHour(7);
        $data = Payment::find($id);
        $user = User::where('id', $data->user_id)->first();
        $product = paymentDetail::where('payment_id', $data->id)->get();
        // dd($data);
        $pdf = Pdf::loadView('admin.hoadon.invoice', ['data' => $data,'user'=>$user, 'product'=>$product, 'date'=>$date]);
        return $pdf->download('Hoa-don'.'.pdf');
        // return view('admin.hoadon.invoice', compact(
        //     'data',
        //     'user',
        //     'product', 'date'
            
        // ));
    }
}
