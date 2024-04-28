<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Nick;
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
        return view('pages.acc', compact('slug', 'slider'));
    }
    public function danhmucgame($slug)
    {
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $category = Category::where('slug', $slug)->first();
        return view('pages.category', compact('slider', 'category'));
    }
    public function danhmuccon($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $nick = Nick::where('category_id', $category->id)->where('status', 1)->paginate(16);
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.acc', compact('slug', 'slider', 'nick', 'category'));
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
