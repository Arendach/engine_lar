@extends('layout')

@section('title', 'Мої звіти')

@breadcrumbs(
    ['Менеджери', uri('user/list')],
    [$user->login, uri('user/view', ['id' => $user->id])],
    ['Всі звіти']
)

@section('content')
    <div class="panel-group" id="accordion">
        @foreach($reports as $year => $items)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $year }}">
                            {{ $year }}
                        </a>
                    </h4>
                </div>
                <div id="collapse{{ $year }}" class="panel-collapse collapse @displayIf($year == year(), 'in')">
                    <div class="panel-body">
                        @for($i = 1; $i <= 12; $i++)
                            @if($items->where('month', $i)->count())
                                <div style="margin-bottom: 5px; color: grey">
                                    <i class="fa fa-dot-circle-o"></i>
                                    <a href="@uri('report/view', ['year' => $year, 'month' => $i, 'user_id' => $user->id])">
                                        {{ int_to_month($i) }}
                                    </a>
                                </div>
                            @else
                                <div style="margin-bottom: 5px; color: grey">
                                    <i class="fa fa-dot-circle-o"></i> {{ int_to_month($i) }}
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection