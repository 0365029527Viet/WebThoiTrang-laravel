<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::orderBy('id', 'desc')->paginate(10);
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('admin.banner.add');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = new Banner();
        $data->title = $request->title;

        $data->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/' . $fileName);

            $data->image = $fileName;
        }
        // dd($data);
        $data->save();
        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $banner)
    {
        $data = Banner::find($banner);
        return view('admin.banner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $banner)
    {
        $data = Banner::find($banner);
        $data->title = $request->title;

        $data->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/' . $fileName);
            // if ($data->image) {
            //     Storage::delete($data->image);
            // }
            $data->image = $fileName;
        }
        $data->update();
        return redirect()->route('banner.index')->with('success', 'Sửa banner thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Banner::find($id)->delete();
        // if ($data) {
        //     Storage::delete($data->image);
        // }
        return redirect()->route('banner.index')->with('success', 'Xóa banner thành công');
    }
}
