<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('admin.posts.index');
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        dd($request->all());
    }   
}
