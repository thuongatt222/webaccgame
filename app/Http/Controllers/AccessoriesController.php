<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use App\Models\Category;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessories = Accessories::with('category')->orderBy('id', 'DESC')->paginate(15);
        return  view('admin.accessories.index', compact('accessories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return  view('admin.accessories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:accessories|max:255',
            'category_id' => 'required|max:255',
            'status' => 'required'
        ], [
            'title.unique' => 'Tên accessories game đã có xin điền tên khác',
            'title.required' => 'Tên accessories game phải có',
            'category_id.required' => 'Danh mục accessories game phải có',
        ]);
        $accessories = new Accessories();
        $accessories->title = $data['title'];
        $accessories->category_id = $data['category_id'];
        $accessories->status = $data['status'];
        $accessories->save();
        return redirect()->route('accessories.index')->with('status', 'Thêm accessories thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $accessories = Accessories::find($id);
        return view('admin.accessories.edit', compact('accessories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|max:255',
            'image' => 'image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'status' => 'required'
        ], [

            'title.required' => 'Tên accessories game phải có',
            'category_id.required' => 'Danh mục accessories game phải có',
        ]);
        $accessories = Accessories::find($id);
        $accessories->title = $data['title'];
        $accessories->category_id = $data['category_id'];
        $accessories->status = $data['status'];
        $accessories->save();
        return redirect()->route('accessories.index')->with('status', 'Thêm accessories thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $accessories = Accessories::find($id);
        return redirect()->route('ac$accessories.index')->with('status', 'Xóa accessories thành công');
    }
}
