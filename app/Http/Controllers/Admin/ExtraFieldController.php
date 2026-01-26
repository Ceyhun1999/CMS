<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ExtraFieldController extends Controller
{
    public function index()
    {
        return view('admin.extra-fields.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.extra-fields.create', [
            'categories' => $categories
        ]);
    }
}
