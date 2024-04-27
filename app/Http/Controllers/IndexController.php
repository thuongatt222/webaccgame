<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.home', compact('category', 'slider'));
    }
    public function dichvu()
    {
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.service', compact('slider'));
    }
    public function dichvucon($slug)
    {
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_service', compact('slug', 'slider'));
    }
    public function danhmucgame($slug)
    {
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.category', compact('slider'));
    }
    public function danhmuccon($slug)
    {
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_category', compact('slug', 'slider'));
    }
    public function blogs()
    {
        $blogs = Blog::orderBy('id', 'DESC')->where('status', 1)->paginate(15);
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.blog', compact('slider', 'blogs'));
    }
    public function blogcon($slug)
    {
        $blog = Blog::orderBy('id', 'DESC')->where('slug', $slug)->first();
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_blog', compact('slider', 'blog'));
    }
}
