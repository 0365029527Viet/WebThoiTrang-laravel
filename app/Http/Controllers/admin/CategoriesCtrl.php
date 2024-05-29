<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::orderBy('id', 'desc')->paginate(15);
        return view('admin.categories.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create() {
        return view('admin.categories.add');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'cate_name' => 'required',
        ]);
        $data = Category::create($request->all());
        if($data){
            return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công');
        }else{
            return back()->error('error', 'Thêm danh mục thất bại');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $category)
    {
        $data = Category::find($category);
        return view('admin.categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category)
    {
        $validate = $request->validate([
            'cate_name' => 'required',
        ]);
        $data = Category::find($category);
        $data->update($request->all());
        if($data){
            return redirect()->route('category.index')->with('success', 'Sửa danh mục thành công');
        }else{
            return back()->error('error', 'Sửa danh mục thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }
}
