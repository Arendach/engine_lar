@extends('layout')

@section('title', 'Менеджери')

@breadcrumbs(['Менеджери'])

@section('content')
    <div class="right" style="margin-bottom: 15px">
        <a href="@uri('user/archive')" class="btn btn-primary">Архів</a>
        <a href="@uri('user/register')" class="btn btn-primary">Реєструвати</a>
    </div>

        <table class="table table-bordered">
            <tr>
                <th>Логін</th>
                <th>Імя</th>
                <th>Курєр</th>
                <th>Графік</th>
                <th>Ставка</th>
                <th>Резерв</th>
                <th>Замовлення</th>
                <th class="right">Інше</th>
            </tr>
            @foreach ($users as $user)
                @php
                    $attachDelivery = $user->getCountAttachDeliveryUser($user->id);
                    $attachSelf = $user->getCountAttachSelfUser($user->id);
                    $attachSending = $user->getCountAttachSendingUser($user->id);
                @endphp
                <tr>
                    <td>
                        <i data-toggle="tooltip"
                           title="{{ $user->online_text }}"
                           style="color: {{ $user->online_color }}"
                           class="fa fa-circle-o"></i>
                        <a href="@uri('user/view', ['id' => $user->id])">
                            {{ $user->login }}
                        </a>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->is_courier ? 'Так' : 'Ні' }}</td>
                    <td>{{ $user->schedule_notice ? 'Так' : 'Ні' }}</td>
                    <td>{{ number_format($user->rate) }}</td>
                    <td>{{ number_format($user->reserve_funds) }}</td>
                    <td>
                        @if ($attachDelivery or $attachSelf or $attachSending)
                            <div class="not_closed_orders">
                                @if($attachDelivery)
                                    <a href="@uri('orders/view', ['type' => 'delivery', 'courier_id' => $user->id, 'status' => 'open']) ?>">
                                        Доставки - {{ $attachDelivery }}
                                    </a><br>
                                @endif

                                @if($attachSelf)
                                    <a href="@uri('orders/view', ['type' => 'self', 'courier_id' => $user->id, 'status' => 'open']) ?>">
                                        Самовивози - {{ $attachSelf }}
                                    </a><br>
                                @endif

                                @if($attachSending)
                                    <a href="@uri('orders/view', ['type' => 'sending', 'courier_id' => $user->id, 'status' => 'open'])">
                                        Відправки - {{ $attachSending }}
                                    </a><br>
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="right">
                        <a href="@uri('report/user', ['id' => $user->id])" class="btn btn-primary btn-xs">
                            <i class="fa fa-dollar"></i> Звіти
                        </a>
                        <a href="@uri('user/update', ['id' => $user->id])" class="btn btn-primary btn-xs">
                            <i class="glyphicon glyphicon-pencil"></i> Редагувати
                        </a>
                        <a href="@uri('task/main', ['user' => $user->id])" class="btn btn-primary btn-xs">
                            <i class="fa fa-list"></i> Завдання
                        </a>
                        <a href="@uri('schedule', ['user' => $user->id])" class="btn btn-primary btn-xs">
                            <i class="fa fa-line-chart"></i> Графік роботи
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
@endsection