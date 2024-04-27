<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::orderBy('id', 'DESC')->paginate(15);
        return  view('admin.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'slug' => 'required|unique:blogs|max:255',
            'content' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'status' => 'required'
        ], [
            'title.unique' => 'Tên danh mục game đã có xin điền tên khác',
            'title.required' => 'Tên danh mục game phải có',
            'slug.unique' => 'Tên slug danh mục game đã có xin điền tên khác',
            'slug.required' => 'Tên slug danh mục game phải có',
            'content.required' => 'Tên content danh mục game phải có',
            'description.required' => 'Mô tả danh mục game phải có',
            'image.required' => 'Hình ảnh phải có',
        ]);

        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->content = $data['content'];
        $blog->description = $data['description'];
        $blog->status = $data['status'];

        $get_image = $request->image;
        $path = 'uploads/blog/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $blog->image = $new_image;
        $blog->save();
        return redirect()->route('blog.index')->with('status', 'Thêm blog thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'slug' => 'required|max:255',
            'content' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'status' => 'required'
        ], [
            'title.unique' => 'Tên blog game đã có xin điền tên khác',
            'title.required' => 'Tên blog game phải có',
            'slug.required' => 'Tên slug blog game phải có',
            'content.required' => 'Tên content blog game phải có',
            'description.required' => 'Mô tả blog game phải có',
            'image.required' => 'Hình ảnh phải có',
        ]);
        $blog = Blog::find($id);
        $blog->content = $data['content'];
        $blog->slug = $data['slug'];
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->status = $data['status'];
        $get_image = $request->image;
        if ($get_image) {
            $path_unlink = 'uploads/blog/' . $blog->image;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $path = 'uploads/blog/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog->image = $new_image;
        }
        $blog->save();
        return redirect()->route('blog.index')->with('status', 'Cập nhật blog thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $path_unlink = 'uploads/blog/' . $blog->image;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $blog->delete();
        return redirect()->route('blog.index')->with('status', 'Xóa blog thành công');
    }
}
