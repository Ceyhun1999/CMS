@extends('admin.layouts.app')
@section('title', 'Добавить новость')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.posts.index') }}">
                    <i class='bx bx-news'></i> Новости
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Добавить новость</li>
        </ol>
    </nav>

    <div class="create-container">
        <div class="create-header">
            <h4>Добавить новость</h4>
            <p>Создание новой публикации</p>
        </div>

        <div class="create-card">
            <form id="postForm" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- TITLE --}}
                <div class="form-group">
                    <label for="title">
                        Заголовок: <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="title" name="title" class="form-control"
                        placeholder="Введите заголовок новости" value="{{ old('title') }}">
                </div>

                {{-- MAIN IMAGE --}}
                <div class="form-group">
                    <label>Главное изображение:</label>

                    @error('main_image')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <div id="main-image-container">
                        <div class="icon-upload-row">
                            <input type="file" name="main_image" class="form-control" accept="image/*">
                            <button type="button" class="btn-remove-icon" title="Удалить" style="display: none;">
                                <i class='bx bx-x'></i>
                            </button>
                        </div>
                    </div>

                    <small class="form-text">
                        Поддерживаемые форматы: JPG, PNG, SVG, WebP
                    </small>
                </div>

                {{-- CONTENT --}}
                <div class="form-group">
                    <label for="content">
                        Краткое описание:
                    </label>
                    <textarea id="shortDesc" name="shortDesc">{{ old('content') }}</textarea>
                </div>

                {{-- CONTENT --}}
                <div class="form-group">
                    <label for="content">
                        Полное описание:
                    </label>
                    <textarea id="fullDesc" name="fullDesc">{{ old('content') }}</textarea>
                </div>

                {{-- DYNAMIC FIELDS CONTAINER --}}
                <div id="dynamicFieldsContainer"></div>

                <div class="form-group">
                    <button type="button" id="addFieldBtn" class="btn btn-expand-all">Добавить поле</button>
                </div>

                {{-- ADD FIELD MODAL --}}
                <div id="addFieldModal" class="field-modal" style="display: none;">
                    <div class="field-modal-content">
                        <h5>Добавление поля</h5>
                        
                        <div class="form-group">
                            <label for="fieldType">Тип поля: <span class="text-danger">*</span></label>
                            <select id="fieldType" class="form-control">
                                <option value="">Выберите тип</option>
                                <option value="text">Одна строка</option>
                                <option value="textarea">Несколько строк</option>
                                <option value="html">Чистый HTML или JS код</option>
                                <option value="list">Список</option>
                                <option value="image">Загружаемое изображение</option>
                                <option value="gallery">Загружаемая галерея изображений</option>
                                <option value="file">Загружаемый файл</option>
                                <option value="checkbox">Переключатель 'Да' или 'Нет'</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fieldName">Название поля (латиница): <span class="text-danger">*</span></label>
                            <input type="text" id="fieldName" class="form-control" placeholder="field_name">
                            <small class="form-text">Только латинские буквы, цифры и подчеркивание</small>
                        </div>

                        <div class="form-group">
                            <label for="fieldDescription">Описание поля: <span class="text-danger">*</span></label>
                            <textarea id="fieldDescription" class="form-control" rows="3" placeholder="Описание для администратора"></textarea>
                        </div>

                        <div class="field-modal-actions">
                            <button type="button" id="confirmAddField" class="btn btn-primary">Добавить</button>
                            <button type="button" id="cancelAddField" class="btn btn-secondary">Отменить</button>
                        </div>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Создать новость</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Полное описание с картинками
            tinymce.init({
                selector: '#fullDesc',
                plugins: 'wordcount charmap media searchreplace link image code lists table fullscreen',
                toolbar: 'fontsize | wordcount | charmap | media | searchreplace | undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link image media table | code fullscreen',
                license_key: 'gpl',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt',
                height: 400,
                menubar: false,
                content_style: 'img { width: 100%; height: auto; }',
                branding: false,
                promotion: false,
                language: 'ru',
                skin: false,
                content_css: false,
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        const reader = new FileReader();
                        reader.addEventListener('load', () => {
                            const id = 'blobid' + (new Date()).getTime();
                            const blobCache = tinymce.activeEditor.editorUpload
                                .blobCache;
                            const base64 = reader.result.split(',')[1];
                            const blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        });
                        reader.readAsDataURL(file);
                    });

                    input.click();
                },
            });

            // Краткое описание без картинок
            tinymce.init({
                selector: '#shortDesc',
                plugins: 'wordcount charmap searchreplace link code lists table fullscreen',
                toolbar: 'fontsize | wordcount | charmap | searchreplace | undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link table | code fullscreen',
                license_key: 'gpl',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt',
                height: 400,
                menubar: false,
                branding: false,
                promotion: false,
                language: 'ru',
                skin: false,
                content_css: false,
            });

            // Add Field Modal
            const addFieldBtn = document.getElementById('addFieldBtn');
            const addFieldModal = document.getElementById('addFieldModal');
            const confirmAddField = document.getElementById('confirmAddField');
            const cancelAddField = document.getElementById('cancelAddField');

            addFieldBtn?.addEventListener('click', () => {
                addFieldModal.style.display = 'flex';
            });

            cancelAddField?.addEventListener('click', () => {
                addFieldModal.style.display = 'none';
                document.getElementById('fieldType').value = '';
                document.getElementById('fieldName').value = '';
                document.getElementById('fieldDescription').value = '';
            });

            confirmAddField?.addEventListener('click', () => {
                const fieldType = document.getElementById('fieldType').value;
                const fieldName = document.getElementById('fieldName').value;
                const fieldDescription = document.getElementById('fieldDescription').value;

                if (!fieldType || !fieldName || !fieldDescription) {
                    alert('Заполните обязательные поля');
                    return;
                }

                // Валидация имени поля (только латиница, цифры, подчеркивание)
                if (!/^[a-zA-Z0-9_]+$/.test(fieldName)) {
                    alert('Название поля должно содержать только латинские буквы, цифры и подчеркивание');
                    return;
                }

                // Создание поля
                createDynamicField(fieldType, fieldName, fieldDescription);
                
                addFieldModal.style.display = 'none';
                document.getElementById('fieldType').value = '';
                document.getElementById('fieldName').value = '';
                document.getElementById('fieldDescription').value = '';
            });

            // Функция создания динамического поля
            function createDynamicField(type, name, description) {
                const container = document.getElementById('dynamicFieldsContainer');
                const fieldDiv = document.createElement('div');
                fieldDiv.className = 'form-group';
                
                let fieldHTML = `<label for="${name}">${description}: <span class="text-danger">*</span></label>`;
                
                switch(type) {
                    case 'text':
                        fieldHTML += `<input type="text" id="${name}" name="${name}" class="form-control" placeholder="${description}">`;
                        break;
                        
                    case 'textarea':
                        fieldHTML += `<textarea id="${name}" name="${name}" class="form-control" rows="4" placeholder="${description}"></textarea>`;
                        break;
                        
                    case 'html':
                        fieldHTML += `<textarea id="${name}" name="${name}" class="form-control">${''}</textarea>`;
                        fieldDiv.innerHTML = fieldHTML;
                        container.appendChild(fieldDiv);
                        
                        // Инициализация TinyMCE для HTML поля
                        tinymce.init({
                            selector: `#${name}`,
                            plugins: 'wordcount charmap media searchreplace link code lists table fullscreen',
                            toolbar: 'fontsize | wordcount | charmap | media | searchreplace | undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link code table | fullscreen',
                            license_key: 'gpl',
                            font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt',
                            height: 400,
                            menubar: false,
                            branding: false,
                            promotion: false,
                            language: 'ru',
                            skin: false,
                            content_css: false,
                        });
                        return;
                        
                    case 'image':
                        fieldHTML += `
                            <div id="${name}-container">
                                <div class="icon-upload-row">
                                    <input type="file" name="${name}" class="form-control" accept="image/*">
                                    <button type="button" class="btn-remove-icon" title="Удалить" style="display: none;">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text">Поддерживаемые форматы: JPG, PNG, SVG, WebP</small>`;
                        break;
                        
                    case 'gallery':
                        fieldHTML += `
                            <div id="${name}-container" class="icons-container-dynamic">
                                <div class="icon-upload-row">
                                    <input type="file" name="${name}[]" class="form-control" accept="image/*">
                                    <button type="button" class="btn-remove-icon" title="Удалить" style="display: none;">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn-add-icon add-gallery-${name}">
                                <i class='bx bx-plus'></i> Добавить ещё изображение
                            </button>
                            <small class="form-text">Поддерживаемые форматы: JPG, PNG, SVG, WebP</small>`;
                        fieldDiv.innerHTML = fieldHTML;
                        container.appendChild(fieldDiv);
                        
                        // Добавление обработчика для галереи
                        document.querySelector(`.add-gallery-${name}`).addEventListener('click', function() {
                            const galleryContainer = document.getElementById(`${name}-container`);
                            const newRow = document.createElement('div');
                            newRow.className = 'icon-upload-row';
                            newRow.innerHTML = `
                                <input type="file" name="${name}[]" class="form-control" accept="image/*">
                                <button type="button" class="btn-remove-icon" title="Удалить">
                                    <i class='bx bx-x'></i>
                                </button>`;
                            galleryContainer.appendChild(newRow);
                            
                            newRow.querySelector('.btn-remove-icon').addEventListener('click', function() {
                                newRow.remove();
                            });
                        });
                        return;
                        
                    case 'file':
                        fieldHTML += `
                            <div id="${name}-container">
                                <div class="icon-upload-row">
                                    <input type="file" name="${name}" class="form-control">
                                    <button type="button" class="btn-remove-icon" title="Удалить" style="display: none;">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text">Любой тип файла</small>`;
                        break;
                        
                    case 'checkbox':
                        fieldHTML += `
                            <div class="checkbox-wrapper-5">
                                <div class="check">
                                    <input id="${name}" name="${name}" type="checkbox" value="1">
                                    <label for="${name}"></label>
                                </div>
                                <span class="switch-label">Включить/Выключить</span>
                            </div>`;
                        break;
                        
                    case 'list':
                        fieldHTML += `<input type="text" id="${name}" name="${name}" class="form-control" placeholder="${description}">`;
                        break;
                }
                
                fieldDiv.innerHTML = fieldHTML;
                container.appendChild(fieldDiv);
            }
        });
    </script>
@endpush
