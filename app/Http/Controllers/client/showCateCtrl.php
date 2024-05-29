<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class showCateCtrl extends Controller
{
    public function showSP() {
        // $data = Category::all();

        $banner = Banner::where('status', 1)->limit(2)->get();
        // return view('template.client', compact('data', 'banner'));
        $data = Product::orderBy('id', 'desc')->where('status', 'New')->get();
        return view('client.trangchu', compact('data', 'banner'));
    }
    public function detail($id)  {
        $data = Product::with('category','sale')->where('id', $id)->get();
        foreach ($data as $item) {
            // dd($item->cate_id);
            //lấy ra tất cả sản phẩm tương tự
            $similar = Product::where('cate_id', $item->cate_id)->get();
        } 
        return view('client.detail', compact('data', 'similar'));
    }
    public function showAll() {
        $title = "OUT SHOP";
        $data = Product::orderBy('id', 'desc')->paginate(9);
        return view('client.allProduct', compact('data', 'title'));
    }
    public function showSpCate($id) {

        $data = Product::orderBy('id', 'desc')->where('cate_id', $id)->paginate(9);
        $cate = Category::find($id);
        
            $title = $cate->cate_name;
       

        return view('client.allProduct', compact('data', 'title'));
    }
}
