<div class="right" style="margin-bottom: 15px">
    <button class="btn btn-primary btn-sm" onclick="$('#hasManyCreate{{ $relationKey }}').toggle()">
        Новий запис
    </button>
</div>

<form action="@uri('setting/hasManyCreate')" id="hasManyCreate{{ $relationKey }}" data-after="reset" data-type="ajax"
      style="display: none">
    <hr>
    <h4>Новий запис</h4>
    <input type="hidden" name="id" value="{{ $row->id }}">
    <input type="hidden" name="part" value="{{ $part }}">
    <input type="hidden" name="relation" value="{{ $relationKey }}">
    @foreach($relation['fields'] as $column =>  $field)
        @include("setting.fields.{$field['type']}", ['name' => $column])
    @endforeach

    <div class="form-group">
        <button class="btn btn-primary btn-sm">Зберегти</button>
    </div>
</form>

<form action="@uri('setting/hasManyUpdate')" id="hasManyUpdate{{ $relationKey }}" data-type="ajax" style="display: none">
    <hr>
    <h4>Новий запис</h4>
    <input type="hidden" name="id" value="{{ $row->id }}">
    <input type="hidden" name="part" value="{{ $part }}">
    <input type="hidden" name="relation" value="{{ $relationKey }}">
    @foreach($relation['fields'] as $column =>  $field)
        @include("setting.fields.{$field['type']}", ['name' => $column])
    @endforeach

    <div class="form-group">
        <button class="btn btn-primary btn-sm">Зберегти</button>
    </div>
</form>

<hr>

<table class="table-bordered table">
    <tr>
        @foreach($relation['fields'] as $column => $field)
            <th>{{ $field['title'] }}</th>
        @endforeach
        <th class="action-2">Дії</th>
    </tr>
    @foreach($items as $item)
        <tr>
            @foreach($relation['fields'] as $column => $field)
                <td>{{ $item->{$column} }}</td>
            @endforeach
            <td class="action-2">
                <button onclick="editableHasMany(this)"
                        data-row="{{ $item->toJson() }}"
                        class="btn btn-primary btn-xs">
                    <i class="fa fa-pencil"></i>
                </button>
                <button data-type="delete"
                        data-uri="@uri('setting/hasManyDelete')"
                        data-post="@params([
                            'part'        => $part,
                            'relation'    => $relationKey,
                            'relation_id' => $item->id
                        ])"
                        data-id="{{ $row->id }}"
                        @tooltip('Видалити')
                        class="btn btn-danger btn-xs">
                    <i class="fa fa-remove"></i>
                </button>
            </td>
        </tr>
    @endforeach
</table>
<script>
    function editableHasMany(button) {
        let form = document.getElementById('hasManyUpdate{{ $relationKey }}')


    }
</script>