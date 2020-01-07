<tr>
    <td>{!!  $space . $item->name !!}</td>
    <td>{{ $item->service_code }}</td>
    <td>
        <button data-type="get_form"
                data-uri="@uri('category/update_form')"
                data-post="{{ params(['id' => $item->id]) }}"
                title="Редагувати"
                class="btn btn-xs btn-primary">
            <i class="fa fa-pencil"></i>
        </button>
        <button data-type="delete"
                data-uri="@uri('category/delete')"
                data-id="{{$item->id}}"
                title="Видалити"
                class="btn btn-xs btn-danger">
            <i class="fa fa-remove"></i>
        </button>
    </td>
</tr>