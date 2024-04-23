<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        return view('pages.home');
    }
    public function dichvu(){
        return view('pages.service');
    }
    public function dichvucon($slug){
        return view('pages.sub_service');
    }
}