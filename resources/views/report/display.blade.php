@extends('layout')

@section('title', 'Мої звіти')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    [$user->login, uri('UserController@sectionView', ['id' => $user->id])],
    ['Всі звіти', uri('ReportController@sectionUser', ['id' => $user->id])],
    [int_to_month($month) . ' ' . $year]
)

@section('content')
    <div class="right">
        <a href="@uri('ReportController@sectionStatistics', ['user' => $report->user_id])" class="btn btn-primary">Статистика</a>
        <a href="@uri('ReportController@sectionReserveFunds')" class="btn btn-success">Резервний фонд</a>
        <a href="@uri('ReportController@sectionMoving')" class="btn btn-success">Переміщення коштів</a>
        <a href="@uri('ReportController@sectionExpenditures')" class="btn btn-success">Видатки</a>
        <a href="@uri('ReportController@sectionShippingCosts')" class="btn btn-success">Витрати на доставку</a>
        @if (can())
            <a href="@uri('ReportController@sectionProfits')" class="btn btn-success">Коректування</a>
        @endif
    </div>

    <br>

    <table class="table">
        <tr>
            <td style="border-top: none" class="right">
                Цього місяця
                <span class="badge">
                    {{ $report->just_now }} грн
                </span>
            </td>

            <td style="border-top: none; text-align: center;">
                На руках <span class="badge" style="background-color: #369">
                    {{ $report->start_month + $report->just_now }} грн
                </span>
            </td>

            <td style="border-top: none">
                На початок місяця <span class="badge">{{ $report->start_month }} грн</span>
            </td>

            <td style="border-top: none" class="right">
                В резерві: <span class="badge" style="background-color: green">{{ $user->reserve_funds }}</span>
            </td>
        </tr>
    </table>

    @if($report->items->count())
        <table class="table table-bordered">
            <tr>
                <td><b>Число</b></td>
                <td><b>Назва операції</b></td>
                <td><b>Тип</b></td>
                <td><b>Сума</b></td>
                <td><b>Коментар</b></td>
                <td class="action-2"><b>Дії</b></td>
            </tr>
            @foreach($report->items as $report)
                <tr style="background-color: {{ $report->type_color }}" data-id="{{ $report->id }}">
                    <td>{{ $report->day }}</td>
                    <td>{{ $report->name_operation }}</td>
                    <td>{{ $report->type_name }}</td>
                    <td>{{ $report->sum }} грн</td>
                    <td>{{ $report->comment }}</td>
                    <td class="action-2 relative">
                        <div id="preview_{{ $report->id }}" class="preview_container"></div>
                        <button class="btn btn-primary btn-xs preview" title="Детальніше...">
                            <i class="fa fa-question "></i>
                        </button>
                        <button data-type="get_form"
                                data-uri="<?= uri('reports') ?>"
                                data-action="update_form"
                                data-post="<?= params(['id' => $report->id]) ?>"
                                class="btn btn-primary btn-xs"
                                title="Редагувати">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif
@endsection