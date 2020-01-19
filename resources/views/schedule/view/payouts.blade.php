@if(can('payouts'))
    <div class="right" style="margin-bottom: 15px;">
        <button @disabled($payouts->sum('sum') >= $salary)
                data-type="get_form"
                data-uri="@uri('ScheduleController@actionCreatePayoutForm')"
                data-id="{{ $schedules->id }}"
                class="btn btn-success">
            Нова виплата
        </button>
    </div>
@endif

@if($payouts->count())
    <table class="table table-bordered">
        <tr>
            <td>Дата виплати</td>
            <td>Сума</td>
            <td>Виплатив</td>
            <td>Коментар</td>
            @if (can('payouts'))
                <td class="action-2">Дії</td>
            @endif
        </tr>
        @foreach ($payouts as $payout)
            <tr>
                <td>{{ $payout->date_payout }}</td>
                <td>{{ number_format($payout->sum) }} грн</td>
                <td>
                    <a href="@uri('user/view', ['id' => $payout->author->id])">
                        {{ $payout->author->login }}
                    </a>
                </td>
                <td>{{ $payout->comment }}</td>
                @if (can('payouts'))
                    <td>
                        <button data-type="get_form"
                                data-uri="@uri('ScheduleController@actionUpdatePayoutForm')"
                                data-id="{{ $payout->id }}"
                                class="btn btn-primary btn-xs"
                                data-toggle="tooltip"
                                title="Редагувати">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('ScheduleController@actionDeletePayout')"
                                data-id="{{ $payout->id }}"
                                data-toggle="tooltip"
                                title="Видалити"
                                class="btn btn-danger btn-xs">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
@else
    <h4 class="centered">Тут пусто :(</h4>
@endif