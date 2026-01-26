@extends('admin.layouts.app')
@section('title', 'Дополнительные поля')

@section('content')
    <div class="content-container">
        <div class="content-header">
            <h4>Список дополнительных полей</h4>
            <a href="{{ route('admin.extra-fields.create') }}" class="btn btn-add-content">
                <i class='bx bx-plus'></i> Добавить поле
            </a>
        </div>

        <div class="posts-table-wrapper">
            <table class="posts-table">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Тип поля</th>
                        <th>Обязательное</th>
                        <th class="col-actions">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Фейковые данные --}}
                    <tr>
                        <td style="width: 40px; text-align: center;">
                            <i class='bx bx-menu' style="cursor: grab; color: #6c757d;"></i>
                        </td>
                        <td>blogminititle</td>
                        <td>Категория: 1</td>
                        <td>Одна строка</td>
                        <td>При желании: Нет</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'blogminititle')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content-footer">
            <a href="{{ route('admin.extra-fields.create') }}" class="btn btn-add-category-green">
                <i class="bx bx-plus"></i> Добавить поле
            </a>
        </div>
    </div>
@endsection
