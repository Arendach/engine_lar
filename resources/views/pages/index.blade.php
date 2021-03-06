@extends('layout', ['editor' => 'full'])

@section('title', 'Адмінка')

@section('content')

    @if ($notifications->count() or $notMovingMoney->count() /*or $productMoving->count()*/)

        <h2><i style="color: red" class="fa fa-bell"></i> Сповіщення</h2>

        @if($notifications->count())
            @foreach($notifications as $notification)
                @php /** @var \App\Models\Notification $notification */ @endphp
                <div class="alert alert-{{ $notification->type }} alert-dismissable">
                    <div class="row">
                        <div class="col-md-9">
                            {!! $notification->content !!}
                        </div>
                        <div class="col-md-3 right">
                            {{ $notification->human('created_at', true) }}
                            <button data-id="{{ $notification->id }}" type="button" class="close closeNotification"
                                    data-dismiss="alert">&times;
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if($notMovingMoney->count() > 0)
            <div class="alert alert-info">
                @foreach($notMovingMoney as $item)
                    Менеджер
                    <a href="{{ uri('manager/' . $item->moving_user_id) }}>">
                        <b class="text-success">{{ user()->login }}</b>
                    </a>
                    ще не підтвердив отримання коштів в сумі
                    <b class="text-success">{{ $item->sum }}</b> грн <br>
                @endforeach
            </div>
        @endif

        <?php /*if (count($product_moving) > 0) { */?>
        <?php /*foreach ($product_moving as $item) { */?>
        <div class="alert alert-success alert-dismissable">
            <div class="row">
                <div class="col-md-9">
                    Прийняти товар від менеджера <?/*= user($item->user_from)->login */?>.
                    <a href="<?/*= uri('product', ['section' => 'print_moving', 'id' => $item->id]) */?>">
                        Детальніше тут.
                    </a>
                </div>
                <div class="col-md-3 right">
                    <?/*= ($item->date) */?> <br>
                    <button data-type="ajax_request"
                            data-uri="<?/*= uri('product') */?>"
                            data-action="close_moving"
                            data-post="<?/*= params(['id' => $item->id]) */?>"
                            type="button"
                            class="btn btn-success btn-xs">
                        Підтвердити
                    </button>
                </div>
            </div>
        </div>
    @endif

    <?php /*if (
    $schedules - 1 > 0 ||
    $schedules_month['work_schedules_month'] > 0 ||
    $nco !== 0 ||
    $liable_orders->self > 0 ||
    $liable_orders->delivery > 0) { */?>

    <h2><i style="color: red" class="fa fa-file-text"></i> Нагадування</h2>

    @if($attachSending or $attachDelivery or $attachSelf)
        <div class="alert alert-info">
            У вас не закрито: <br>

            @if($attachSending)
                <a href="{{ uri('orders/view', ['type' => 'sending', 'courier' => user()->id, 'status' => 'open']) }}">
                    Відправки - <b style="color: red">{{ $attachSending }}</b><br>
                </a>
            @endif

            @if($attachDelivery)
                <a href="{{ uri('orders/view', ['type' => 'delivery', 'courier' => user()->id, 'status' => 'open']) }}">
                    Доставки - <b style="color: red">{{ $attachDelivery }}</b><br>
                </a>
            @endif

            @if($attachSelf)
                <a href="{{ uri('orders/view', ['type' => 'self', 'courier' => user()->id, 'status' => 'open']) }}">
                    Відправки - <b style="color: red">{{ $attachSelf }}</b><br>
                </a>
            @endif
        </div>
    @endif

    @if($liableDelivery or $liableSelf)
        <div class="alert alert-success">
            За вами закріплені замовлення: <br>
            @if($liableSelf > 0)
                <a href="{{ uri('orders', ['type' => 'self', 'liable' => user()->id, 'from' => date('Y-m-d', time() - 60 * 60 * 24 * 90), 'to' => date('Y-m-d', time() + 60 * 60 * 24 * 365)]) }}">
                    Самовивози - <b class="text-danger">{{ $liableSelf }}</b>
                </a>
            @endif

            @if($liableDelivery > 0 and $liableSelf > 0)
                <br>
            @endif

            @if($liableDelivery > 0)
                <a href="{{ uri('orders', ['type' => 'delivery', 'liable' => user()->id, 'from' => date('Y-m-d', time() - 60 * 60 * 24 * 90), 'to' => date('Y-m-d', time() + 60 * 60 * 24 * 365)]) }}">
                    Доставки - <b class="text-danger">{{ $liableDelivery }}</b>
                </a>
            @endif
        </div>
    @endif


    @if(!user()->schedule_notice)
        @if($schedules)
            <div class="alert alert-warning alert-dismissable">
                <div class="form-group">
                    <strong>Увага!</strong> За цей місяць у вашому графіку не заповнено -
                    <b style="color: red">{{ $schedules }}</b> днів!<br>
                </div>
                <a class="btn btn-primary btn-sm" href="{{ uri('schedule/view') }}">
                    Заповнити
                </a>
            </div>
        @endif

        @if($schedulesPrevious)
            <div class="alert alert-danger alert-dismissable">
                <div class="form-group">
                    <strong>Увага!</strong> За минулий місяць у вашому графіку не заповнено
                    - <b style="color: red">{{ $schedulesPrevious }}</b> днів!<br>
                </div>
                <a class="btn btn-primary btn-sm"
                   href="{{ uri('schedule/view', ['year' => previous_month_with_year()['year'], 'month' => previous_month()]) }}">
                    Заповнити
                </a>
            </div>
        @endif
    @endif

    @if($movingMoney->count() > 0 or $tasks->count() > 0)

        <h2><i class="fa fa-automobile text-danger"></i> Задачі</h2>

        @if($movingMoney->count() > 0)
            @foreach ($movingMoney as $report)
                @php /** @var \App\Models\Report $report */ @endphp
                <div class="alert alert-info">
                    <div class="row">
                        <div class="col-md-9">
                            Менеджер <b>{{ $report->user->name }}</b> хоче передати вам <b>{{ $report->sum }}</b> грн
                        </div>
                        <div class="col-md-3 right">
                            {{ $report->human('created_at', true) }} <br>
                            <button data-type="get_form"
                                    data-uri="@uri('report/close_moving_form')"
                                    data-post="@params(['id' => $item->id])" class="btn btn-xs btn-success">
                                Підтвердити
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


        @if ($tasks->count())
            @foreach ($tasks as $task)
                @php /** @var \App\Models\Task $task */ @endphp
                <div class="alert alert-{{ $task->type }}">
                    <div class="row">
                        <div class="col-md-9">
                            @if($task->price)
                                <b>Бюджет задачі:</b>
                                <span class="text-success">
                                    {{ $task->numberFormat('price') }}
                                </span>
                                <br>
                            @endif
                            <div>
                                {!! $task->editable('content') !!}
                            </div>
                        </div>
                        <div class="right col-md-3">
                            <div class="form-group">
                                Задача поставлена: {{ $task->created_at->format('d.m.Y') }}<br>
                                @if(!is_null($task->updated_at))
                                    Ост. редагування: {{ $task->updated_at->format('d.m.Y') }} <br>
                                @endif
                            </div>

                            <div class="form-group">
                                <button data-type="get_form"
                                        data-uri="@uri('task@closeForm')"
                                        data-post="@params(['id' => $task->id, 'type' => 'success'])"
                                        class="btn btn-xs btn-success">
                                    Виконано
                                </button>
                                <button data-type="get_form"
                                        data-uri="@uri('task@closeForm')"
                                        data-post="@params(['id' => $task->id, 'type' => 'danger'])"
                                        class="btn btn-xs btn-danger">
                                    Не виконано
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endif

@stop

@push('scripts')
    <script src="{{ asset('js/index.js') }}"></script>
@endpush