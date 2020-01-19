<table class="table table-bordered">
    <tr>
        <th>Амортизація авто</th>
        <th>Бонуси</th>
        <th>Штрафи</th>
        @if (can('bonuses'))
            <th class="action-1">Дія</th>
        @endif
    </tr>
    <tr>
        <td>{{ number_format($schedules->for_car) }} грн</td>
        <td>{{ number_format($schedules->bonus) }} грн</td>
        <td>{{ number_format($schedules->fine) }} грн</td>
        @if (can('bonuses'))
            <td class="action-1">
                <button data-type="get_form"
                        data-uri="@uri('ScheduleController@actionUpdateBonusesForm')"
                        data-id="{{ $schedules->id }}"
                        class="btn btn-primary btn-xs">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
        @endif
    </tr>
</table>

@if(can('bonuses'))
    <div class="right" style="margin: -5px 0 15px 0;">
        <button data-type="get_form"
                data-uri="@uri('ScheduleController@createBonusForm')"
                data-id="{{ $schedules->id }}"
                class="btn btn-success">
            Новий бонус
        </button>
    </div>
@endif

@if ($bonuses->count())
    <table class="table table-bordered">
        <tr>
            <th>Причина</th>
            <th>Бонус/Штраф</th>
            <th>Сума</th>
            @if (can('bonuses'))
                <th class="action-1">Дія</th>
            @endif
        </tr>
        @foreach ($bonuses as $item)
            <tr style="background-color: {{ $item->type_color }}">
                <td><a href="{{ $item->source_link }}">{{ $item->source_text }}</a></td>
                <td>{{ $item->type_text }}</td>
                <td>{{ number_format($item->sum )}} грн</td>
                @if(can('bonuses'))
                    <td class="action-1">
                        <button data-type="get_form"
                                data-uri="@uri('ScheduleController@actionUpdateBonusForm')"
                                data-post="@params([
                                    'id'    => $item->id,
                                    'year'  => $schedules->year,
                                    'month' => $schedules->month,
                                    'user'  => $schedules->user
                                ])"
                                class="btn btn-primary btn-xs">
                            <span class="fa fa-pencil"></span>
                        </button>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
@endif