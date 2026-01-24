@extends('admin.layouts.app')
@section('title', 'Новости')

@section('content')
    <div class="content-container">
        <div class="content-header">
            <h4>Список новостей</h4>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-add-content">
                <i class='bx bx-plus'></i> Добавить новость
            </a>
        </div>

        <div class="posts-table-wrapper">
            <table class="posts-table">
                <thead>
                    <tr>
                        <th class="col-title">Заголовок</th>
                        <th class="col-views"><i class='bx bx-show'></i></th>
                        <th class="col-comments"><i class='bx bx-message-rounded'></i></th>
                        <th class="col-status">Статус</th>
                        <th class="col-category">Категория</th>
                        <th class="col-actions">
                            Действия
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Фейковые данные --}}
                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">12.01.2026</span>
                                <a href="#" class="post-title">Alman markası Schwartau Werke artıq EuroProduct
                                    portfelində</a>
                            </div>
                        </td>
                        <td class="col-views">14</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Xəbərlər</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Alman markası Schwartau Werke artıq EuroProduct portfelində')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">Pambıq Dişlər Dərı Üçün Yaxşıdırmı?</a>
                            </div>
                        </td>
                        <td class="col-views">6</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Pambıq Dişlər Dərı Üçün Yaxşıdırmı?')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">Düyü Çərayi Sağlamdırmı? Dietoloqan Rəyi</a>
                            </div>
                        </td>
                        <td class="col-views">3</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Düyü Çərayi Sağlamdırmı? Dietoloqan Rəyi')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">Dad, aroma və sağlamlıq faydalarına görə ən yaxşı 5
                                    Seylon çayı</a>
                            </div>
                        </td>
                        <td class="col-views">4</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Dad, aroma və sağlamlıq faydalarına görə ən yaxşı 5 Seylon çayı')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">Julius Meinl: Zamanla Formalaşan Dad</a>
                            </div>
                        </td>
                        <td class="col-views">0</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Julius Meinl: Zamanla Formalaşan Dad')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">Zeytun Yağı Alarkan Nəyə Diqqət Etməli</a>
                            </div>
                        </td>
                        <td class="col-views">8</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Zeytun Yağı Alarkan Nəyə Diqqət Etməli')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">1919-dan Gələn Xırtılıtı</a>
                            </div>
                        </td>
                        <td class="col-views">5</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), '1919-dan Gələn Xırtılıtı')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-title">
                            <div class="post-title-wrapper">
                                <span class="post-date">08.01.2026</span>
                                <a href="#" class="post-title">Lakaların Təmizlənməsi Üçün Ən Əhəmli Bələdçi</a>
                            </div>
                        </td>
                        <td class="col-views">4</td>
                        <td class="col-comments">0</td>
                        <td class="col-status">
                            <span class="status-badge status-active">
                                <i class='bx bx-check-circle'></i>
                            </span>
                        </td>
                        <td class="col-category">Bloqlar</td>
                        <td class="col-actions">
                            <div class="post-actions">
                                <a href="#" class="btn-action btn-edit" title="Редактировать">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="#" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete" title="Удалить"
                                        onclick="showConfirmModal(this.closest('form'), 'Lakaların Təmizlənməsi Üçün Ən Əhəmli Bələdçi')">
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
            <button type="button" class="btn btn-expand-all">Развернуть все</button>
            <button type="button" class="btn btn-collapse-all">Свернуть все</button>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-add-category-green">
                <i class="bx bx-plus"></i> Добавить новость
            </a>
        </div>
    </div>
@endsection
