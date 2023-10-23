<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = Blog::get()->load('category');
        return view('user.index',compact('data'));
    }
}
