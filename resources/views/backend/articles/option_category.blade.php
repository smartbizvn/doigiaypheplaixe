<option value="{{ $category->id }}"
    {{ $selected_id == $category->id ? 'selected' : '' }}>
    {{ str_repeat('— ', $level) . $category->name }}
</option>

@foreach ($category->children_categories as $child)
    @include('backend.articles.option_category', [
        'category' => $child,
        'selected_id' => $selected_id,
        'level' => $level + 1
    ])
@endforeach