@if(can())
    <div class="right" style="margin-bottom: 15px;">
        <button data-type="get_form"
                data-uri="@uri('ScheduleController@actionUpdateHeadForm')"
                data-id="{{ $schedules->id }}"
                class="btn btn-success">Редагувати
        </button>
    </div>
@endif

<table class="table-bordered table">
    <tr>
        <td>Коефіціент</td>
        <td>{{ $schedules->coefficient }}</td>
    </tr>

    <tr>
        <td>ЗП</td>
        <td>{{ number_format($priceMonth) }} грн</td>
    </tr>

    <tr>
        <td>Бонуси за перепрацювання</td>
        <td>{{ number_format($schedules->hour_price * $schedules->up_working_hours * $schedules->coefficient) }} грн</td>
    </tr>

    <tr>
        <td>Амортизація авто</td>
        <td>{{ $schedules->for_car }} грн</td>
    </tr>
    <tr>
        <td>Бонуси</td>
        <td>{{ $schedules->bonus }} грн</td>
    </tr>
    <tr>
        <td>Штрафи</td>
        <td>{{ $schedules->fine }} грн</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <td>
            Нараховано:
            <i style="color: blue">
                {{ number_format($salary) }} грн
            </i>
        </td>

        <td class="centered">
            До виплати:
            <i style="color: red">
                {{ number_format($salary - $payouts->sum('sum')) }} грн
            </i>
        </td>

        <td class="right">
            Виплачено:
            <i style="color: green;">
                {{ number_format($payouts->sum('sum')) }}грн
            </i>
        </td>
    </tr>
</table>