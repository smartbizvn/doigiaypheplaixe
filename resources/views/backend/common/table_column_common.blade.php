@if ($type_column == 'head')
    <th class="text-center" width="120">Trạng thái</th>
    <th class="text-center" width="120">Cập nhật</th>
    <th class="text-center" width="120">Ngày tạo</th>
    <th class="text-center" width="100">Thao tác</th>
@else
    <td class="text-center">
        @if ($result->active == true)
            <span data-id="{{ $result->id }}" class="change_item_status badge badge-soft-success badge-border cursor_pointer">Hoạt động</span>
        @else
            <span data-id="{{ $result->id }}" class="change_item_status badge badge-soft-danger badge-border cursor_pointer">Không hoạt động</span>
        @endif
    </td>
    <td class="text-center">
        {{ viewDateTime($result->updated_at) }}
    </td>
    <td class="text-center">
        {{ viewDateTime($result->created_at) }}
    </td>
    <td class='text-center'>
        @can($module.'_edit')
            <a title='Sửa' href="{{ route('admin.'.$module.'.edit', $result->id) }}" class="text-primary d-inline-block edit-item-btn cursor_pointer">
                <i class="las la-edit fs-18"></i>
            </a>
        @endcan
        @can($module.'_delete')
            <span title='Xóa' data-id='{{$result->id}}' class="delete_item text-danger d-inline-block remove-item-btn ms-2 cursor_pointer">
                <i class="las la-trash-alt fs-18"></i>
            </span>
        @endcan
    </td>
@endif
