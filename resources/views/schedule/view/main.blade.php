<table class="table  table-bordered">
    <tr>
        <td class="centered">Вихідних: {{ $holidays }} дн.</td>
        <td class="centered">Робочих: {{ $working }} дн.</td>
        <td class="centered">У відпустці: {{ $vacation }} дн.</td>
        <td class="centered">Лікарняних: {{ $hospital }} дн.</td>
    </tr>
    <tr>
        <td class="centered">Робочих: {{ $working_hours - $up_working_hours }} год.</td>
        <td class="centered">Лікарняних: {{ $hospital_hours }} год.</td>
        <td class="centered" colspan="2">Перепрацьовано: {{ $up_working_hours }} год.</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <td>Число</td>
        <td>День</td>
        <td>Тип</td>
        <td>Початок</td>
        <td>Кінець</td>
        <td>Обід</td>
        <td>Пропрцьовано</td>
        <td>Перевиконано</td>
        @if (can() || user()->id == $schedules->user_id)
            <td class="action-1">Дія</td>
        @endif
    </tr>
    @for($i = 1; $i < days_in_month($schedules->month, $schedules->year) + 1; $i++)
        @php
            $date = "{$schedules->year}-{$schedules->month}-{$i}";
            $color = (date_to_day($date) == 'Неділя' || date_to_day($date) == 'Субота') ? '#f00' : '#2FAC7C';
        @endphp

        @if ($schedules->items->where('day', $i)->count())
            @php
                $item = $schedules->items->where('day', $i)->first()
            @endphp
            <tr style="background-color: rgba(0,255,0,.2)">
                <td>{{ $i }}</td>
                <td style="color: {{ $color }}">{{ date_to_day($date) }}</td>
                <td>
                    <span style="color: {{ $item->type_color }}">
                        <b>{{ $item->type_name }}</b>
                    </span>
                </td>
                <td>{{ $item->turn_up }}</td>
                <td>{{ $item->went_away }}</td>
                <td>{{ $item->dinner_break }}</td>
                <td><span style="color: {{ $item->worked_color }}">{{ $item->worked }} год</span></td>
                <td>{{ $item->recycling }} год</td>
                @if(can('schedule') || user()->id == $schedules->user_id)
                    <td class="action-1">
                        <button data-type="get_form"
                                data-post="@params(['id' => $item->id])"
                                data-uri="@uri('ScheduleController@actionUpdateDayForm')"
                                class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </td>
                @endif
            </tr>
        @else
            <tr style="background-color: rgba(255,0,0,.2)">
                <td>{{ $i }}</td>
                <td style="color: {{ $color }}">{{ date_to_day($date) }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @if(can('schedule') || user()->id == $schedules->user_id)
                    <td class="action-1">
                        @if ($schedules->month == month() && $i > day())
                            <button class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-lock"></span>
                            </button>
                        @else
                            <button data-type="get_form"
                                    data-uri="@uri('ScheduleController@actionCreateDayForm')"
                                    data-post="@params([
                                        'year'    => $schedules->year,
                                        'month'   => $schedules->month,
                                        'day'     => $i,
                                        'user_id' => $schedules->user_id
                                    ])"
                                    class="btn btn-primary btn-xs get_form">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        @endif
                    </td>
                @endif
            </tr>
        @endif
    @endfor
</table>