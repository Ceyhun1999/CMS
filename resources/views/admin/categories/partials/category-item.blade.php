@foreach ($categories as $category)
    @php
        $hasChildren = $category->children->isNotEmpty();
    @endphp

    <div class="category-item {{ $hasChildren ? 'has-children' : '' }}" style="margin-left: {{ $level * 20 }}px">

        <div class="category-row">
            <span class="drag-handle">
                <i class='bx bx-menu'></i>
            </span>

            @if ($hasChildren)
                <button type="button" class="toggle-children">
                    <i class='bx bx-plus'></i>
                </button>
            @endif

            <span class="category-status {{ $category->is_active ? 'active' : 'inactive' }}">
                <i class='bx bxs-check-circle'></i>
            </span>

            <span class="category-info">
                <span class="category-id">ID: {{ $category->id }}</span>
                <a href="#" class="category-name">{{ $category->title }}</a>
            </span>

            <span class="category-posts">Публикаций: 0</span>

            <div class="category-actions">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-action btn-edit">
                    <i class='bx bx-edit'></i>
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-action btn-delete" 
                        onclick="showConfirmModal(this.closest('form'), '{{ $category->title }}')">
                        <i class='bx bx-trash'></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- 🔁 рекурсивный вызов --}}
        @if ($hasChildren)
            <div class="subcategories">
                @include('admin.categories.partials.category-item', [
                    'categories' => $category->children,
                    'level' => $level + 1,
                ])
            </div>
        @endif
    </div>
@endforeach
