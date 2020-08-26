<div class="content-left content-left-{{ $_COOKIE['left-content-state'] ?? 'open' }}">

    <ul>
        <li>
            <a href="{{ uri('shop/orders/main') }}">
                <i class="fa fa-newspaper-o"></i>
                <span>
                    Нових замовлень - <b class="text-danger">
                        {{ app(\App\Repositories\Shop\OrderRepository::class)->getNewOrdersAllConnection() }}
                    </b>
                </span>
            </a>
        </li>
        @foreach (assets('menu') as $k => $item)
            @if (!isset($item['access']) || $item['access'] == false || can($item['access']))
                <li {!! isset($item['menu']) ? 'class="dropdown"' : '' !!}>
                    <a href="{{ $item['url'] }}">
                        <i class="fa fa-{{ $item['icon'] }}"></i>
                        <span>{{ $item['name'] }}</span>

                        @isset($item['menu'])
                            <ul class="dropdown-{{ $k }}">
                                @foreach ($item['menu'] as $key => $inner)
                                    @if(!isset($inner['access']) || $inner['access'] == false || can($inner['access']))
                                        <li>
                                            <a href="{{ $inner['url'] }}">
                                                <i class="fa fa-angle-double-right"></i>
                                                <span>{{ $inner['name'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endisset
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>