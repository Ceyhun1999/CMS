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
        });
    </script>
@endpush
