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
        <td>{{ $schedules->for_car }} грн</td>
        <td>{{ $schedules->bonus }} грн</td>
        <td>{{ $schedules->fine }} грн</td>
        @if (can('bonuses'))
            <td class="action-1">
                <button data-type="get_form"
                        data-uri="@uri('ScheduleController@actionUpdateBonuseForm')"
                        data-post="@params([
                            'year'  => $schedules->year,
                            'month' => $schedules->month,
                            'user_id'  => $schedules->user_id,
                        ])"
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
                <td>{{ $item->sum }} грн</td>
                @if(can('bonuses'))
                    <td class="action-1">
                        <button data-type="get_form"
                                data-uri="@uri('ScheduleController@actionUpdateBonusForm')"
                                data-post="@params([
                                    'id'    => $item->id,
                                    'year'  => $data->year,
                                    'month' => $data->month,
                                    'user'  => $data->user
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