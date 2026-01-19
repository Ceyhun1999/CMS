<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::query()->whereNull('parent_id')->orderBy('created_at')->get();
        $categories = $categories->map(function () {
            return $this->sortChildrenRecursive($category);
        });
        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', [
            'categories' => $categories
        ]);
    }

    protected function sortChildrenRecursive($category)
    {
        $category->children = $category->children()
            ->orderBy('title')
            ->get()
            ->map(fn($child) => $this->sortChildrenRecursive($child));

        return $category;
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
            'parent_id' => ['nullable', 'numeric', 'exists:categories,id'],

            // SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],

            // Настройки новостей
            'news_sort_field' => ['required', 'string', 'in:created_at,updated_at,rating,views,title,comments_count'],
            'news_sort_order' => ['required', 'in:asc,desc'],
            'include_subcategories' => ['nullable', 'boolean'],
            'news_per_page' => ['required', 'numeric', 'min:1', 'max:100'],

            // Системные
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'numeric', 'min:0'],
        ]);

        $validated['include_subcategories'] = $request->boolean('include_subcategories');
        $validated['is_active'] = $request->boolean('is_active');

        $category = Category::create($validated);

        return redirect()->route('admin.categories.create')->with('success', 'Категория успешно создана');
    }
}
