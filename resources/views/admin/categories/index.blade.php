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
            @include('admin.categories.partials.category-item', [
                'categories' => $categories,
                'level' => 0,
            ])
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

            document.querySelectorAll('.toggle-children').forEach(btn => {
                btn.addEventListener('click', function() {
                    const item = this.closest('.category-item');
                    item.classList.toggle('expanded');

                    const icon = this.querySelector('i');
                    icon.classList.toggle('bx-plus');
                    icon.classList.toggle('bx-minus');
                });
            });

            document.querySelector('.btn-expand-all')?.addEventListener('click', () => {
                document.querySelectorAll('.category-item.has-children').forEach(item => {
                    item.classList.add('expanded');
                    const icon = item.querySelector('.toggle-children i');
                    icon?.classList.remove('bx-plus');
                    icon?.classList.add('bx-minus');
                });
            });

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
