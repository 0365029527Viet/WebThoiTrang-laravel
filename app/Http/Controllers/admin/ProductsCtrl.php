<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with('category','sale')->orderBy('id','desc')->paginate(15);
        return view('admin.product.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create() {
        $sale = Sale::all();
        $cate = Category::all();
        return view('admin.product.add', compact('sale', 'cate'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = new Product();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->description = $request->description;
        if($request->size){
            //hàm implode để kết hợp các giá trị trong mảng thành một chuỗi, với dấu phẩy (,) làm phân tách
            $data->size = implode(',' ,$request->size); 
        }
        $data->number = $request->number;
        $data->status = $request->status;
        $data->cate_id = $request->cate_id;
        $data->sale_id = $request->sale_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/'.$fileName);
            $data->image = $fileName;
        }
        $data->save();
        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $product)
    {
        $data = Product::find($product);
        $sale = Sale::all();
        $cate = Category::all();
        return view('admin.product.edit', compact('data','sale', 'cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product)
    {
        $data = Product::find($product);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->description = $request->description;
        if($request->size){
            //hàm implode để kết hợp các giá trị trong mảng thành một chuỗi, với dấu phẩy (,) làm phân tách
            $data->size = implode(',' ,$request->size); 
        }
        $data->number = $request->number;
        $data->status = $request->status;
        $data->cate_id = $request->cate_id;
        $data->sale_id = $request->sale_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/'.$fileName);
            if($data->image){
                Storage::delete($data->image);
            }
            $data->image = $fileName;
        }
        $data->update();
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Product::find($id)->delete();
        if($data){
            Storage::delete($data->image);
        }
        return redirect()->route('product.index')->with('success', 'Xóa thành công');
    }
}
