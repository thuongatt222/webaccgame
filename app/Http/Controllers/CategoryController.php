<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->paginate(5);
        return  view('admin.category.index', compact('category'));
    }
    public function create()
    {
        return  view('admin.category.create');
    }
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'status' => 'required'
        ], [
            'title.unique' => 'Tên danh mục game đã có xin điền tên khác',
            'title.required' => 'Tên danh mục game phải có',
            'slug.unique' => 'Tên slug danh mục game đã có xin điền tên khác',
            'slug.required' => 'Tên slug danh mục game phải có',
            'description.required' => 'Mô tả danh mục game phải có',
            'image.required' => 'Hình ảnh phải có',
        ]);

        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        $get_image = $request->image;
        $path = 'uploads/category/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $category->image = $new_image;
        $category->save();
        return redirect()->route('category.index')->with('status', 'Thêm danh mục thành công');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'status' => 'required'
        ], [

            'title.required' => 'Tên danh mục game phải có',
            'slug.required' => 'Tên slug danh mục game phải có',
            'description.required' => 'Mô tả danh mục game phải có',

        ]);
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $get_image = $request->image;
        if ($get_image) {
            $path_unlink = 'uploads/category/' . $category->image;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $path = 'uploads/category/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $category->image = $new_image;
        }
        $category->save();
        return redirect()->route('category.index')->with('status', 'Cập nhật danh mục thành công');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $path_unlink = 'uploads/category/' . $category->image;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $category->delete();
        return redirect()->route('category.index')->with('status', 'Xóa danh mục thành công');
    }
}
