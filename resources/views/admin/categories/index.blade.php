@extends('admin.layouts.app')
@section('title', 'Категории')

@section('content')
    <div class="categories-container">
        <div class="categories-header">
            <h4>Список категорий</h4>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-add-category">
                <i class='bx bx-plus'></i> Добавить новую категорию
            </a>
        </div>

        <div class="categories-list">
            @foreach ($categories as $category)
                <div class="category-item">
                    <div class="category-row">
                        <span class="drag-handle"><i class='bx bx-menu'></i></span>
                        <span class="category-status active"><i class='bx bxs-check-circle'></i></span>
                        <span class="category-info">
                            <span class="category-id">ID:{{ $category->id }}</span>
                            <a href="#" class="category-name">{{ $category->title }}</a>
                        </span>
                        <span class="category-posts">Публикаций: 0</span>
                        <div class="category-actions">
                            <a href="#" class="btn-action btn-edit" title="Редактировать"><i
                                    class='bx bx-edit'></i></a>
                            <button type="button" class="btn-action btn-delete" title="Удалить"><i
                                    class='bx bx-trash'></i></button>
                        </div>
                    </div>
                </div>
            @endforeach



            {{-- Категория С подкатегориями --}}
            <div class="category-item has-children">
                <div class="category-row">
                    <span class="drag-handle"><i class='bx bx-menu'></i></span>
                    <button type="button" class="toggle-children"><i class='bx bx-plus'></i></button>
                    <span class="category-status active"><i class='bx bxs-check-circle'></i></span>
                    <span class="category-info">
                        <span class="category-id">ID:2</span>
                        <a href="#" class="category-name">Brendlər</a>
                    </span>
                    <span class="category-posts">Публикаций: 16</span>
                    <div class="category-actions">
                        <a href="#" class="btn-action btn-edit" title="Редактировать"><i class='bx bx-edit'></i></a>
                        <button type="button" class="btn-action btn-delete" title="Удалить"><i
                                class='bx bx-trash'></i></button>
                    </div>
                </div>
                {{-- Подкатегории (скрыты по умолчанию) --}}
                <div class="subcategories">
                    <div class="category-item subcategory">
                        <div class="category-row">
                            <span class="drag-handle"><i class='bx bx-menu'></i></span>
                            <span class="category-status active"><i class='bx bxs-check-circle'></i></span>
                            <span class="category-info">
                                <span class="category-id">ID:10</span>
                                <a href="#" class="category-name">Brand 1</a>
                            </span>
                            <span class="category-posts">Публикаций: 5</span>
                            <div class="category-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать"><i
                                        class='bx bx-edit'></i></a>
                                <button type="button" class="btn-action btn-delete" title="Удалить"><i
                                        class='bx bx-trash'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="categories-footer">
            <button type="button" class="btn btn-expand-all">Развернуть все</button>
            <button type="button" class="btn btn-collapse-all">Свернуть все</button>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-add-category-green">
                <i class='bx bx-plus'></i> Добавить новую категорию
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Переключение подкатегорий
            document.querySelectorAll('.toggle-children').forEach(btn => {
                btn.addEventListener('click', function() {
                    const item = this.closest('.category-item');
                    item.classList.toggle('expanded');
                    const icon = this.querySelector('i');
                    icon.classList.toggle('bx-plus');
                    icon.classList.toggle('bx-minus');
                });
            });

            // Развернуть все
            document.querySelector('.btn-expand-all')?.addEventListener('click', () => {
                document.querySelectorAll('.category-item.has-children').forEach(item => {
                    item.classList.add('expanded');
                    const icon = item.querySelector('.toggle-children i');
                    icon?.classList.remove('bx-plus');
                    icon?.classList.add('bx-minus');
                });
            });

            // Свернуть все
            document.querySelector('.btn-collapse-all')?.addEventListener('click', () => {
                document.querySelectorAll('.category-item.has-children').forEach(item => {
                    item.classList.remove('expanded');
                    const icon = item.querySelector('.toggle-children i');
                    icon?.classList.remove('bx-minus');
                    icon?.classList.add('bx-plus');
                });
            });
        });
    </script>
@endpush
