@inject('userModel', App\Models\User)
<form action="@uri('orders/create_user_bonus')" data-type="ajax">
    <input type="hidden" name="order_id" value="{{ $order->id }}">

    <div class="form-group">
        <label>
            <input @disabled($order->liable != user()->id) checked type="radio" name="type" value="bonus"> Бонус
        </label>

        <br>

        <label>
            <input @disabled($order->liable != user()->id) type="radio" name="type" value="fine"> Штраф
        </label>
    </div>

    <div class="form-group">
        <label>Співробітник</label>
        <select @disabled($order->liable != user()->id) class="form-control" name="user_id">
            <option value=""></option>
            @foreach ($userModel->all() as $item)
                @continue($order->bonuses->where('user_id', $item->id)->count())
                <option value="{{ $item->id }}">
                    {{ $item->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="sum">Сума</label>
        <input @disabled($order->liable != user()->id) class="form-control" name="sum">
    </div>

    <div class="form-group">
        <button @disabled($order->liable != user()->id) class="btn btn-primary">Зберегти</button>
    </div>
</form>

@if($order->bonuses->count())
    <table class="table table-bordered">
        <tr>
            <th>Співробітник</th>
            <th>Сума</th>
            <th>Бонус/Штраф</th>
            <th>Дата</th>
            <th class="action-2">Дії</th>
        </tr>
        @foreach($bonuses as $item)
            <tr style="background-color: {{ $item->color}}">
                <td>{{ $item->user->full_name }}</td>
                <td>{{ number_format($item->sum) }}</td>
                <td>{{ $item->type_text }}</td>
                <td>{{ $item->date_human }}</td>
                <td class="action-2">
                    <button @data(['type' => 'get_form', 'uri' => uri('orders/update_bonus_form'), 'post' => ['id' => $item->id]])
                            class="btn btn-xs btn-primary"
                            title="Редагувати">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>

                    <button @data(['type' => 'delete', 'uri' => uri('orders/delete_bonus'), 'id' => $item->id])
                            class="delete_bonus btn btn-xs btn-danger"
                            title="Видалити">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
@endif



