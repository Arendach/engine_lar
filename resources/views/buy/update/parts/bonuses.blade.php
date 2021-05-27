@inject('userModel', 'App\Models\User')

<form action="@uri('orders/create_bonus')" data-type="ajax" data-after="reload">
    <input type="hidden" name="data" value="{{ $order->id }}">
    <input type="hidden" name="source" value="order">

    <div class="form-group">
        <label>
            <input @disabled($order->liable_id != user()->id) checked type="radio" name="is_profit" value="1"> Бонус
        </label>

        <br>

        <label>
            <input @disabled($order->liable_id != user()->id) type="radio" name="is_profit" value="0"> Штраф
        </label>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> Співробітник</label>
        <select @disabled($order->liable_id != user()->id) class="form-control" name="user_id">
            <option value=""></option>
            @foreach ($userModel->all() as $item)
                @continue($order->bonuses->where('user_id', $item->id)->count())
                <option value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label><i class="text-danger">*</i> Сума</label>
        <input @disabled($order->liable_id != user()->id) class="form-control" name="sum">
    </div>

    <div class="form-group">
        <button @disabled($order->liable_id != user()->id) class="btn btn-primary">Зберегти</button>
    </div>
</form>

@if($order->bonuses->count())
    <table class="table table-bordered" style="margin-top: 30px">
        <tr>
            <th>Співробітник</th>
            <th>Сума</th>
            <th>Бонус/Штраф</th>
            <th>Дата</th>
            <th class="action-1">Дії</th>
        </tr>
        @foreach($order->bonuses as $item)
            @php /** @var \App\Models\Bonus $item */ @endphp
            <tr style="background-color: {{ $item->color}}">
                <td>{{ $item->user->name }}</td>
                <td>{{ number_format($item->sum) }}</td>
                <td>{{ $item->type_text }}</td>
                <td>{{ $item->human('created_at', true) }}</td>
                <td class="action-1">
                    <button @data(['type' => 'delete', 'uri' => uri('orders/delete_bonus'), 'id' => $item->id])
                            class="delete_bonus btn btn-xs btn-danger"
                            @tooltip('Видалити')>
                        <span class="fa fa-remove"></span>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
@endif



