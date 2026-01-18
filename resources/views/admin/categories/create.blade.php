@extends('admin.layouts.app')
@section('title', 'Добавить категорию')

@section('content')
    <div class="settings-container">
        <div class="settings-header">
            <h4>Добавить категорию</h4>
            <p>Создание новой категории для публикаций</p>
        </div>

        <div class="settings-card">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- SUCCESS --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- TITLE --}}
                <div class="form-group">
                    <label for="title">
                        Название категории: <span class="text-danger">*</span>
                        <span id="title_counter" class="char-counter">(0/255)</span>
                    </label>

                    @error('title')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="title" name="title"
                        class="form-control @error('title') is-invalid @enderror" maxlength="255" required
                        placeholder="Введите название категории"
                        value="{{ old('title') }}">
                </div>

                {{-- PARENT CATEGORY --}}
                <div class="form-group">
                    <label for="parent_id">Родительская категория:</label>

                    @error('parent_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <select id="parent_id" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                        <option value="">-- Без родительской категории --</option>
                    </select>

                    <small class="form-text">
                        Выберите родительскую категорию, если хотите создать подкатегорию
                    </small>
                </div>

                {{-- SLUG --}}
                <div class="form-group">
                    <label for="slug">
                        URL (Slug):
                        <span id="slug_counter" class="char-counter">(0/255)</span>
                    </label>

                    @error('slug')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="slug" name="slug"
                        class="form-control @error('slug') is-invalid @enderror" maxlength="255"
                        placeholder="url-kategorii (генерируется автоматически)"
                        value="{{ old('slug') }}">

                    <small class="form-text">
                        Оставьте пустым для автоматической генерации из названия
                    </small>
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-group">
                    <label for="description">
                        Описание категории (HTML):
                        <span id="description_counter" class="char-counter">(0/5000)</span>
                    </label>

                    @error('description')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <textarea id="description" name="description" rows="4" maxlength="5000"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="HTML описание категории">{{ old('description') }}</textarea>
                </div>

                {{-- ICONS --}}
                <div class="form-group">
                    <label>Иконки категории:</label>

                    @error('icons')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    @error('icons.*')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <div id="icons-container">
                        <div class="icon-upload-row">
                            <input type="file" name="icons[]" class="form-control" accept="image/*">
                            <button type="button" class="btn-remove-icon" title="Удалить" style="display: none;">
                                <i class='bx bx-x'></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" id="add-icon-btn" class="btn-add-icon">
                        <i class='bx bx-plus'></i> Добавить ещё иконку
                    </button>

                    <small class="form-text">
                        Поддерживаемые форматы: JPG, PNG, SVG, WebP
                    </small>
                </div>

                <hr class="form-divider">

                {{-- META TITLE --}}
                <div class="form-group">
                    <label for="meta_title">
                        Meta Title:
                        <span id="meta_title_counter" class="char-counter">(0/255)</span>
                    </label>

                    @error('meta_title')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="meta_title" name="meta_title"
                        class="form-control @error('meta_title') is-invalid @enderror" maxlength="255"
                        placeholder="SEO заголовок страницы"
                        value="{{ old('meta_title') }}">
                </div>

                {{-- META DESCRIPTION --}}
                <div class="form-group">
                    <label for="meta_description">
                        Meta Description:
                        <span id="meta_description_counter" class="char-counter">(0/500)</span>
                    </label>

                    @error('meta_description')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <textarea id="meta_description" name="meta_description" rows="2" maxlength="500"
                        class="form-control @error('meta_description') is-invalid @enderror"
                        placeholder="SEO описание для поисковых систем">{{ old('meta_description') }}</textarea>
                </div>

                {{-- META KEYWORDS --}}
                <div class="form-group">
                    <label for="meta_keywords">
                        Meta Keywords:
                        <span id="meta_keywords_counter" class="char-counter">(0/500)</span>
                    </label>

                    @error('meta_keywords')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="meta_keywords" name="meta_keywords" maxlength="500"
                        class="form-control @error('meta_keywords') is-invalid @enderror"
                        placeholder="ключевое слово 1, ключевое слово 2"
                        value="{{ old('meta_keywords') }}">
                </div>

                <hr class="form-divider">

                {{-- NEWS SETTINGS --}}
                <div class="form-group">
                    <label for="news_sort_field">Сортировка новостей по:</label>

                    @error('news_sort_field')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <select id="news_sort_field" name="news_sort_field" class="form-control @error('news_sort_field') is-invalid @enderror">
                        <option value="created_at" {{ old('news_sort_field', 'created_at') == 'created_at' ? 'selected' : '' }}>По дате публикации</option>
                        <option value="updated_at" {{ old('news_sort_field') == 'updated_at' ? 'selected' : '' }}>По дате редактирования</option>
                        <option value="rating" {{ old('news_sort_field') == 'rating' ? 'selected' : '' }}>По рейтингу</option>
                        <option value="views" {{ old('news_sort_field') == 'views' ? 'selected' : '' }}>По просмотрам</option>
                        <option value="title" {{ old('news_sort_field') == 'title' ? 'selected' : '' }}>По алфавиту</option>
                        <option value="comments_count" {{ old('news_sort_field') == 'comments_count' ? 'selected' : '' }}>По количеству комментариев</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="news_sort_order">Порядок сортировки новостей:</label>

                    @error('news_sort_order')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <select id="news_sort_order" name="news_sort_order" class="form-control @error('news_sort_order') is-invalid @enderror">
                        <option value="desc" {{ old('news_sort_order', 'desc') == 'desc' ? 'selected' : '' }}>По убыванию</option>
                        <option value="asc" {{ old('news_sort_order') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="news_per_page">Новостей на странице:</label>

                    @error('news_per_page')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="number" id="news_per_page" name="news_per_page"
                        class="form-control @error('news_per_page') is-invalid @enderror"
                        placeholder="10" min="1" max="100"
                        value="{{ old('news_per_page', 10) }}">
                </div>

                {{-- INCLUDE SUBCATEGORIES --}}
                <div class="form-group">
                    <label>Включать подкатегории</label>

                    @error('include_subcategories')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="hidden" name="include_subcategories" value="0">

                    <div class="checkbox-wrapper-5">
                        <div class="check">
                            <input type="checkbox" id="include_subcategories" name="include_subcategories" value="1"
                                {{ old('include_subcategories', true) ? 'checked' : '' }}>
                            <label for="include_subcategories"></label>
                        </div>
                        <span class="switch-label">
                            Показывать новости из подкатегорий
                        </span>
                    </div>
                </div>

                <hr class="form-divider">

                {{-- SORT ORDER --}}
                <div class="form-group">
                    <label for="sort_order">Порядок сортировки:</label>

                    @error('sort_order')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="number" id="sort_order" name="sort_order"
                        class="form-control @error('sort_order') is-invalid @enderror"
                        placeholder="0" min="0"
                        value="{{ old('sort_order', 0) }}">

                    <small class="form-text">
                        Чем меньше число, тем выше категория в списке
                    </small>
                </div>

                {{-- STATUS --}}
                <div class="form-group">
                    <label>Статус категории</label>

                    @error('is_active')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="hidden" name="is_active" value="0">

                    <div class="checkbox-wrapper-5">
                        <div class="check">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active"></label>
                        </div>
                        <span class="switch-label">
                            Категория активна и отображается на сайте
                        </span>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Создать категорию</button>
                    <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        'use strict';

        const fields = [
            {id: 'title', counter: 'title_counter', max: 255},
            {id: 'slug', counter: 'slug_counter', max: 255},
            {id: 'description', counter: 'description_counter', max: 5000},
            {id: 'meta_title', counter: 'meta_title_counter', max: 255},
            {id: 'meta_description', counter: 'meta_description_counter', max: 500},
            {id: 'meta_keywords', counter: 'meta_keywords_counter', max: 500}
        ];

        const initCounter = ({id, counter, max}) => {
            const input = document.getElementById(id);
            const counterEl = document.getElementById(counter);

            if (!input || !counterEl) {
                console.warn(`Counter elements not found: ${id} or ${counter}`);
                return;
            }

            const update = () => {
                const len = input.value.length;
                counterEl.textContent = `(${len}/${max})`;
                counterEl.style.color = len > max * 0.9 ? '#dc3545' : len > max * 0.7 ? '#ffc107' : '#198754';
            };

            update();
            input.addEventListener('input', update);
        };

        fields.forEach(initCounter);

        // Dynamic icon upload fields
        const iconsContainer = document.getElementById('icons-container');
        const addIconBtn = document.getElementById('add-icon-btn');

        const updateRemoveButtons = () => {
            const rows = iconsContainer.querySelectorAll('.icon-upload-row');
            rows.forEach((row, index) => {
                const removeBtn = row.querySelector('.btn-remove-icon');
                removeBtn.style.display = rows.length > 1 ? 'flex' : 'none';
            });
        };

        const createIconRow = () => {
            const row = document.createElement('div');
            row.className = 'icon-upload-row';
            row.innerHTML = `
                <input type="file" name="icons[]" class="form-control" accept="image/*">
                <button type="button" class="btn-remove-icon" title="Удалить">
                    <i class='bx bx-x'></i>
                </button>
            `;
            return row;
        };

        addIconBtn?.addEventListener('click', () => {
            const newRow = createIconRow();
            iconsContainer.appendChild(newRow);
            updateRemoveButtons();
        });

        iconsContainer?.addEventListener('click', (e) => {
            const removeBtn = e.target.closest('.btn-remove-icon');
            if (removeBtn) {
                removeBtn.closest('.icon-upload-row').remove();
                updateRemoveButtons();
            }
        });

        updateRemoveButtons();
    });
</script>
@endpush