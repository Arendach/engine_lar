<form action="@uri('sms/send_message')" data-type="ajax" id="form-sms-send" data-after="reload">
    <input type="hidden" name="order_id" value="{{ $order->id }}">

    <div class="form-group">
        <label>Номер отримувача</label>
        <input name="phone" class="form-control" value="{{  $order->phone_format }}">
    </div>

    <div class="form-group">
        <label>Шаблон</label>
        <select id="sms-template" class="form-control">
            <option value=""></option>
            @foreach($sms_templates as $item)
                <option value="{{  $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="text">Повідомлення</label>
        <textarea id="sms-text" name="text" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">Відправити</button>
    </div>
</form>

@if($order->sms_messages->count())
    <h2>Відправлені СМС</h2>

    <table class="table table-bordered">
        <tr>
            <th>Текст</th>
            <th>Телефон</th>
            <th>Дата</th>
            <th>Статус</th>
        </tr>
        @foreach($order->sms_messages as $message)
            @php /** @var \App\Models\SmsMessage $message */ @endphp
            <tr>
                <td>{{ $message->text }}</td>
                <td>{{ $message->phone }}</td>
                <td>{{ $message->human('created_at', true)}}</td>
                <td>{{ $message->status_name }}</td>
            </tr>
        @endforeach
    </table>
@endif