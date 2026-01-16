@extends('admin.layouts.app')

@section('content')
    <div class="settings-container">
        <div class="settings-header">
            <h4>Настройка системы</h4>
            <p>Основные параметры конфигурации сайта</p>
        </div>

        <div class="settings-card">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- SUCCESS --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- WEBSITE NAME --}}
                <div class="form-group">
                    <label for="website_name">
                        Название сайта:
                        <span id="website_name_counter" class="char-counter">(0/255)</span>
                    </label>

                    @error('website_name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="website_name" name="website_name"
                        class="form-control @error('website_name') is-invalid @enderror" maxlength="255" required
                        placeholder='например: "Моя домашняя страница"'
                        value="{{ old('website_name', $settings->website_name ?? '') }}">
                </div>

                {{-- WEBSITE URL --}}
                <div class="form-group">
                    <label for="website_url">
                        Домашняя страница сайта:
                        <span id="website_url_counter" class="char-counter">(0/255)</span>
                    </label>

                    @error('website_url')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="website_url" name="website_url"
                        class="form-control @error('website_url') is-invalid @enderror" maxlength="255" required
                        placeholder="http://yoursite.com/" value="{{ old('website_url', $settings->website_url ?? '') }}">

                    <small class="form-text">
                        Укажите основной домен сайта (например: http://yoursite.com/)
                    </small>
                </div>

                {{-- META DESCRIPTION --}}
                <div class="form-group">
                    <label for="meta_description">
                        Описание сайта (Description):
                        <span id="meta_description_counter" class="char-counter">(0/1000)</span>
                    </label>

                    @error('meta_description')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <textarea id="meta_description" name="meta_description" rows="3" maxlength="1000"
                        class="form-control @error('meta_description') is-invalid @enderror"
                        placeholder="Краткое описание, не более 1000 символов">{{ old('meta_description', $settings->meta_description ?? '') }}</textarea>
                </div>

                {{-- META KEYWORDS --}}
                <div class="form-group">
                    <label for="meta_keywords">
                        Ключевые слова (Keywords):
                        <span id="meta_keywords_counter" class="char-counter">(0/1000)</span>
                    </label>

                    @error('meta_keywords')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="meta_keywords" name="meta_keywords" maxlength="1000"
                        class="form-control @error('meta_keywords') is-invalid @enderror"
                        placeholder="ключевое слово 1, ключевое слово 2"
                        value="{{ old('meta_keywords', $settings->meta_keywords ?? '') }}">
                </div>

                {{-- WEBSITE SHORTNAME --}}
                <div class="form-group">
                    <label for="website_shortname">
                        Краткое название сайта:
                        <span id="website_shortname_counter" class="char-counter">(0/100)</span>
                    </label>

                    @error('website_shortname')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="text" id="website_shortname" name="website_shortname" maxlength="100"
                        class="form-control @error('website_shortname') is-invalid @enderror" placeholder="Краткое название"
                        value="{{ old('website_shortname', $settings->website_shortname ?? '') }}">
                </div>

                {{-- WEBSITE OFFLINE --}}
                <div class="form-group">
                    <label>Выключить сайт</label>

                    @error('website_offline')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    <input type="hidden" name="website_offline" value="0">

                    <div class="checkbox-wrapper-5">
                        <div class="check">
                            <input type="checkbox" id="website_offline" name="website_offline" value="1"
                                {{ old('website_offline', $settings->website_offline ?? false) ? 'checked' : '' }}>
                            <label for="website_offline"></label>
                        </div>
                        <span class="switch-label">
                            Перевести сайт в состояние offline для технических работ
                        </span>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <button type="reset" class="btn btn-secondary">Сбросить</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    (() => {
        'use strict';
        
        const fields = [
            {id: 'website_name', counter: 'website_name_counter', max: 255},
            {id: 'website_url', counter: 'website_url_counter', max: 255},
            {id: 'meta_description', counter: 'meta_description_counter', max: 1000},
            {id: 'meta_keywords', counter: 'meta_keywords_counter', max: 1000},
            {id: 'website_shortname', counter: 'website_shortname_counter', max: 100}
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

        document.addEventListener('DOMContentLoaded', () => fields.forEach(initCounter));
    })();
</script>
@endpush
