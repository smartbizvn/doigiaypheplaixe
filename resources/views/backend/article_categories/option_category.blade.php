@php
    $prefix = str_repeat('-- ', $level);
@endphp

@if (!in_array($category->id, $exclude_ids ?? []))
    <option value="{{ $category->id }}" {{ $category->id == $selected_id ? 'selected' : '' }}>
        {{ $prefix . $category->name }}
    </option>
@endif

@if ($category->children_categories && $category->children_categories->count())
    @foreach ($category->children_categories as $child)
        @include('backend.article_categories.option_category', [
            'category' => $child,
            'selected_id' => $selected_id,
            'exclude_ids' => $exclude_ids,
            'level' => $level + 1
        ])
    @endforeach
@endif
