<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::query()->whereNull('parent_id')->orderBy('created_at')->get();
        $categories = $categories->map(function ($category) {
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

        $paths = [];

        if ($request->hasFile('icons')) {
            foreach ($request->file('icons') as $icon) {
                $path = $icon->store('icons', 'public');
                $paths[] = $path;

                $filename = time() . '_' . uniqid() . '.' . $icon->getClientOriginalExtension();
                $path = $icon->storeAs('categories/icons', $filename, 'public');
            }
        }

        $validated['icons'] = $paths ?: null;
        $validated['include_subcategories'] = $request->boolean('include_subcategories');
        $validated['is_active'] = $request->boolean('is_active');


        $category = Category::create($validated);

        return redirect()->route('admin.categories.create')->with('success', 'Категория успешно создана');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $id,
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'
            ],

            'description' => ['nullable', 'string', 'max:65535'],

            'icons' => ['nullable', 'array'],
            'icons.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg,webp', 'max:2048'],

            'delete_icons'   => ['nullable', 'array'],
            'delete_icons.*' => ['integer', 'min:0'],


            'parent_id' => ['nullable', 'numeric', 'exists:categories,id'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],

            'news_sort_field' => ['required', 'string', 'in:created_at,updated_at,rating,views,title,comments_count'],
            'news_sort_order' => ['required', 'in:asc,desc'],
            'include_subcategories' => ['nullable', 'boolean'],
            'news_per_page' => ['required', 'numeric', 'min:1', 'max:100'],

            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'numeric', 'min:0'],
        ]);
        $category = Category::query()->findOrFail($id);

        $validated['include_subcategories'] = $request->boolean('include_subcategories');
        $validated['is_active'] = $request->boolean('is_active');

        $existingIcons = $category->icons ?? [];

        if ($request->filled('delete_icons')) {
            foreach ($request->delete_icons as $index) {
                if (isset($existingIcons[$index])) {
                    Storage::disk('public')->delete($existingIcons[$index]);
                    unset($existingIcons[$index]);
                }
            }
        }
        $existingIcons = array_values($existingIcons);

        if ($request->hasFile('icons')) {

            $newIcons = [];

            foreach ($request->file('icons') as $icon) {
                $filename = time() . '_' . uniqid() . '.' . $icon->getClientOriginalExtension();
                $newIcons[] = $icon->storeAs('categories/icons', $filename, 'public');
            }

            // ➕ объединяем старые и новые
            $existingIcons = array_merge($existingIcons, $newIcons);
        }

        $validated['icons'] = $existingIcons;

        $category->update($validated);

        return redirect()->route('admin.categories.edit', $category->id)->with('success', 'Категория успешно обновлена');
    }

    public function edit($id)
    {
        $category = Category::query()->findOrFail($id);
        $categories = Category::all();

        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id);

        // Удаляем иконки из storage
        if ($category->icons) {
            foreach ($category->icons as $icon) {
                Storage::disk('public')->delete($icon);
            }
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена');
    }

    protected function sortChildrenRecursive($category)
    {

        $category->children = $category->children()
            ->orderBy('created_at')
            ->get()
            ->map(function ($child) {
                return $this->sortChildrenRecursive($child);
            });

        return $category;
    }
}
