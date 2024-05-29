<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sale::orderBy('id', 'desc')->paginate(15);
        return view('admin.sale.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create() {
        return view('admin.sale.add');
    }
    public function store(Request $request)
    {
        //
        $data = Sale::create($request->all());

        return redirect()->route('sale.index')->with('success', 'Thêm thành công');
        
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $sale)
    {
        //
        $data = Sale::find($sale);
        return view('admin.sale.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $sale)
    {
        //
        $data = Sale::find($sale)->update($request->all());
        return redirect()->route('sale.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Sale::find($id)->delete();
        return redirect()->route('sale.index')->with('success', 'Xóa thành công');
    }
}
