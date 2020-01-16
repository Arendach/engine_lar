@extends('layout')

@if ($user->id == user()->id)
    @section('title', 'Мій профіль :: Мої графіки роботи')

@breadcrumbs(
    ['Мій профіль', uri('user', ['section' => 'profile'])],
    ['Мої графіки роботи']
)
@else
    @section('title', "Менеджери :: Графіки роботи {$user->login}")

@breadcrumbs(
    ['Менеджери', uri('user')],
    [$user->login, uri('user', ['section' => 'view', 'id' => $user->id])],
    ['Графіки роботи']
)
@endif

@section('content')
    @if($schedules->count())
        <div class="panel-group" id="accordion">
            @foreach($schedules as $year => $months)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $year }}">
                                {{ $year }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $year }}"
                         class="panel-collapse collapse @displayIf($year == date('Y'), 'in')">
                        <div class="panel-body">
                            @for($i = 1; $i <= 12; $i++)
                                @php
                                    $month = $months->where('month', $i)->first();
                                @endphp

                                @if(!is_null($month))
                                    <div>
                                        <i class="fa fa-dot-circle-o"></i>
                                        <a href="@uri('schedule/view', ['year' => $year, 'month' => $i, 'user' => $month->user_id])">
                                            {{ int_to_month($i) }}
                                        </a>
                                    </div>
                                @else
                                    <div>
                                        <i class="fa fa-dot-circle-o"></i> {{ int_to_month($i) }}
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

@endsection