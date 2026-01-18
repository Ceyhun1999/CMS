<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],

            // Slug может быть пустым (генерируется автоматически)
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],

            // Ограничение для TEXT поля в MySQL
            'description' => ['nullable', 'string', 'max:65535'],

            // Иконки как массив файлов
            'icons' => ['nullable', 'array'],
            'icons.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg,webp', 'max:2048'],

            // Родительская категория
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],

            // SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],

            // Настройки новостей
            'news_sort_field' => ['required', 'string', 'in:created_at,updated_at,rating,views,title,comments_count'],
            'news_sort_order' => ['required', 'in:asc,desc'],
            'include_subcategories' => ['nullable', 'boolean'],
            'news_per_page' => ['required', 'integer', 'min:1', 'max:100'],

            // Системные
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
