@extends('admin.layouts.app')
@section('title', 'Добавить дополнительное поле')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.extra-fields.index') }}">
                    <i class='bx bx-list-plus'></i> Дополнительные поля
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Добавить поле</li>
        </ol>
    </nav>

    <div class="create-container">
        <div class="create-header">
            <h4>Добавить дополнительное поле</h4>
            <p>Создание нового поля для публикаций</p>
        </div>

        <div class="create-card">
            <form id="extraFieldForm" action="#" method="POST">
                @csrf

                {{-- FIELD NAME --}}
                <div class="form-group">
                    <label for="name">
                        Название поля (латиница): <span class="text-danger">*</span>
                    </label>
                    <input required type="text" id="name" name="name" class="form-control"
                        placeholder="field_name" value="{{ old('name') }}">
                    <small class="form-text">Только латинские буквы, цифры и подчеркивание</small>
                </div>

                {{-- FIELD LABEL --}}
                <div class="form-group">
                    <label for="label">
                        Описание поля: <span class="text-danger">*</span>
                    </label>
                    <input required type="text" id="label" name="label" class="form-control"
                        placeholder="Описание для администратора" value="{{ old('label') }}">
                </div>

                {{-- FIELD TYPE --}}
                <div class="form-group">
                    <label for="type">Тип поля: <span class="text-danger">*</span></label>
                    <select id="type" name="type" class="form-control">
                        <option value="">Выберите тип</option>
                        <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Одна строка</option>
                        <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>Несколько строк</option>
                        <option value="html" {{ old('type') == 'html' ? 'selected' : '' }}>Чистый HTML или JS код</option>
                        <option value="list" {{ old('type') == 'list' ? 'selected' : '' }}>Список</option>
                        <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Загружаемое изображение</option>
                        <option value="gallery" {{ old('type') == 'gallery' ? 'selected' : '' }}>Загружаемая галерея изображений</option>
                        <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>Загружаемый файл</option>
                        <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>Переключатель 'Да' или 'Нет'</option>
                    </select>
                </div>

                {{-- LIST OPTIONS (показывается только для типа "Список") --}}
                <div class="form-group" id="listOptionsGroup" style="display: none;">
                    <label>Опции списка: <span class="text-danger">*</span></label>
                    <div class="select-options-builder">
                        <div class="options-list" id="optionsList"></div>
                        <div class="add-option-row">
                            <input type="text" id="optionInput" class="form-control" placeholder="Введите значение опции">
                            <button type="button" id="addOptionBtn" class="btn-add-option">
                                <i class='bx bx-plus'></i> Добавить
                            </button>
                        </div>
                    </div>
                    <small class="form-text">Добавьте минимум одну опцию для списка</small>
                </div>

                {{-- CATEGORY --}}
                <div class="form-group">
                    <label for="category_id">Категория:</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">-- Все категории --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <small class="form-text">Выберите категорию, к которой относится поле, или оставьте пустым для всех</small>
                </div>

                {{-- REQUIRED --}}
                <div class="form-group">
                    <label>Обязательное поле</label>
                    <input type="hidden" name="is_required" value="0">
                    <div class="checkbox-wrapper-5">
                        <div class="check">
                            <input type="checkbox" id="is_required" name="is_required" value="1"
                                {{ old('is_required') ? 'checked' : '' }}>
                            <label for="is_required"></label>
                        </div>
                        <span class="switch-label">Поле обязательно для заполнения</span>
                    </div>
                </div>


                {{-- ACTIONS --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Создать поле</button>
                    <a href="{{ route('admin.extra-fields.index') }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const typeSelect = document.getElementById('type');
            const listOptionsGroup = document.getElementById('listOptionsGroup');
            const optionsList = document.getElementById('optionsList');
            const optionInput = document.getElementById('optionInput');
            const addOptionBtn = document.getElementById('addOptionBtn');
            
            let options = [];

            // Показ/скрытие блока опций при выборе типа "Список"
            typeSelect?.addEventListener('change', () => {
                if (typeSelect.value === 'list') {
                    listOptionsGroup.style.display = 'block';
                } else {
                    listOptionsGroup.style.display = 'none';
                }
            });

            // Добавление опции
            addOptionBtn?.addEventListener('click', () => {
                const value = optionInput.value.trim();
                if (value && !options.includes(value)) {
                    options.push(value);
                    renderOptions();
                    optionInput.value = '';
                }
            });

            // Добавление опции по Enter
            optionInput?.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addOptionBtn.click();
                }
            });

            // Отрисовка опций
            function renderOptions() {
                optionsList.innerHTML = '';
                options.forEach((option, index) => {
                    const optionItem = document.createElement('div');
                    optionItem.className = 'option-item';
                    optionItem.innerHTML = `
                        <span class="option-text">${option}</span>
                        <button type="button" class="btn-remove-option" data-index="${index}" title="Удалить">
                            <i class='bx bx-x'></i>
                        </button>
                        <input type="hidden" name="options[]" value="${option}">
                    `;
                    optionsList.appendChild(optionItem);
                    
                    optionItem.querySelector('.btn-remove-option').addEventListener('click', function() {
                        options.splice(index, 1);
                        renderOptions();
                    });
                });
            }

            // Валидация формы
            const form = document.getElementById('extraFieldForm');
            form?.addEventListener('submit', (e) => {
                const name = document.getElementById('name').value.trim();
                const label = document.getElementById('label').value.trim();
                const type = document.getElementById('type').value;

                if (!name || !label || !type) {
                    e.preventDefault();
                    alert('Заполните обязательные поля');
                    return;
                }

                // Валидация имени поля
                if (!/^[a-zA-Z0-9_]+$/.test(name)) {
                    e.preventDefault();
                    alert('Название поля должно содержать только латинские буквы, цифры и подчеркивание');
                    return;
                }

                // Проверка опций для списка
                if (type === 'list' && options.length === 0) {
                    e.preventDefault();
                    alert('Добавьте минимум одну опцию для списка');
                    return;
                }
            });
        });
    </script>
@endpush