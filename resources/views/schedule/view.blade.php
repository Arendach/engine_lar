@extends('layout')

@if($user->id == user()->id)
    @section('title', 'Мій профіль :: Мій графік роботи')

    @breadcrumbs(
        ['Мій профіль', uri('user/profile')],
        ['Графіки роботи', uri('schedule/main')],
        [int_to_month($month) . ' ' . $year]
    )
@else
    @section('title', "Менеджери :: Графік роботи $user->login")

    @breadcrumbs(
        ['Менеджери', uri('user/list')],
        [$user->login, uri('user/view', ['id' => $user->id])],
        ['Графіки роботи', uri('schedule', ['user' => $user->id])],
        [int_to_month($month) . ' ' . $year]
    )
@endif

@section('content')
    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#main" data-toggle="tab">Графік</a></li>
        <li><a href="#bonuses" data-toggle="tab">Бонуси і штрафи</a></li>
        <li><a href="#payouts" data-toggle="tab">Виплати</a></li>
        <li><a href="#all" data-toggle="tab">Підсумки</a></li>
    </ul>

    <div class="tab-content" style="margin-top: 15px;">
        <div class="tab-pane active" id="main">
            @include('schedule.view.main')
        </div>

        <div class="tab-pane" id="bonuses">
            {{--            @include('schedule.view.bonuses')--}}
        </div>

        <div class="tab-pane" id="payouts">

            {{--            @include('schedule.view.payouts')--}}
        </div>

        <div class="tab-pane" id="all">
            {{--            @include('schedule.view.all')--}}
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {

            var $body = $('body');

            $body.on('keyup', '#work_day', function () {
                var worked = +$('#went_away').val() - (+$('#turn_up').val() + +$('#dinner_break').val());
                if (worked < +$('#work_day').val())
                    $('#work_day').val(worked);
            });

            $body.on('keyup', '.time', function () {
                var $this = $(this);
                var array = [];
                for (var i = 0; i < 25; i++)
                    array.push(i);

                if ($.inArray(+$this.val(), array) === -1)
                    $($this.val(0))
            });

            $body.on('change', '[name=type]', function () {
                if ($(this).val() == '2' || $(this).val() == '3') {
                    $('#turn_up').val('9').attr('disabled', 'disabled');
                    $('#went_away').val('17').attr('disabled', 'disabled');
                    $('#dinner_break').val('0').attr('disabled', 'disabled');
                    $('#work_day').val('8').attr('disabled', 'disabled');
                } else {
                    $('#turn_up').removeAttr('disabled');
                    $('#went_away').removeAttr('disabled');
                    $('#dinner_break').removeAttr('disabled');
                    $('#work_day').removeAttr('disabled');
                }
            });

        });
    </script>
@endsection