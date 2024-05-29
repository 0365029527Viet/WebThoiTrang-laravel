<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCart($idUser)
    {


        $data = Cart::with('user', 'product.sale')->where('user_id', $idUser)->get();
        return view('client.cart', compact('data'));
    }
    public function addCart(Request $request)
    {
        $productID = $request->product_id;
        $userID = $request->user_id;

        if ($userID == 0) {
            Session::put('saveUrl', url()->previous());
            toastr()->warning('Đăng nhập để thêm sản phẩm!');
            return redirect()->route('login');
        }

        $existingCart = Cart::where('user_id', $userID)
            ->where('product_id', $productID)
            ->first();

        if ($existingCart) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật lại thông tin
            $size = $existingCart->size;
            $number = $existingCart->number;
            $existingCart->update([
                'size' => $size . ',' . $request->size,
                'number' => $number + $request->number
            ]);
            toastr()->success('Đã update sản phẩm trong giỏ hàng');
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, tạo mới
            Cart::create($request->all());
            toastr()->success('Đã thêm sản phẩm vào giỏ hàng');
        }

        return back();
    }
    public function destroyCart($id) {
        $data = Cart::find($id)->delete();
        toastr()->success('Đã xóa sản phẩm khỏi giỏ hàng');
        return back();
    }
    
}
