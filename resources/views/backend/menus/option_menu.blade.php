@php
    $prefix = str_repeat('-- ', $level);
@endphp

@if (!in_array($menu->id, $exclude_ids ?? []))
    <option value="{{ $menu->id }}" {{ $menu->id == $selected_id ? 'selected' : '' }}>
        {{ $prefix . $menu->name }}
    </option>
@endif

@if ($menu->children_menus && $menu->children_menus->count())
    @foreach ($menu->children_menus as $child)
        @include('backend.menus.option_menu', [
            'menu' => $child,
            'selected_id' => $selected_id,
            'exclude_ids' => $exclude_ids,
            'level' => $level + 1
        ])
    @endforeach
@endif