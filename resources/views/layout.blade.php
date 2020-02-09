<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Enter Title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }} }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" id="baze-theme" href="{{ asset('css/themes/' . user()->theme . '.css') }}">

    <script>
        @isset($toJs)
            window.JData = @json($toJs)
                @endisset

            window.pin = '{{ user()->pin }}';
        window.my_url = '{{ '' }}';
    </script>

    @yield('scripts')

    <script src="{{ asset('js/libs.js') }}"></script>

    @if (isset($editor) && $editor == 'full')
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    @else
        <script src="{{ asset('ckeditor_basic/ckeditor.js') }}"></script>
    @endif

    <script src="{{ asset('js/pjax.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
<div>
    <input style="display: none" name="login" type="text">
    <input style="display: none" name="password" type="password">
</div>

<div class="content-left content-left-{{ $_COOKIE['left-content-state'] ?? 'open' }}">
    <ul>
        @foreach (assets('menu') as $k => $item)
            @if (!isset($item['access']) || $item['access'] == false || can($item['access']))
                <li {{ isset($item['menu']) ? 'class="dropdown"' : '' }}>
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

<div class="content-right content-right-{{ $_COOKIE['left-content-state'] ?? 'open' }}">
    <nav class="navbar navbar-{{ $_COOKIE['left-content-state'] ?? 'open' }} navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button style="display: block" class="navbar-toggle map-signs"
                        data-state="{{ $_COOKIE['left-content-state'] ?? 'open' }}">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @foreach(assets('menu') as $k => $item )
                        @if(!isset($item['access']) || $item['access'] == false || can($item['access']))
                            <li {{ isset($item['menu']) ? 'class="dropdown"' : '' }}>
                                <a href="{{ $item['url'] }}" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>{{ $item['name'] }}</span>
                                    @isset($item['menu'])
                                        <span class="caret"></span>
                                    @endisset
                                </a>
                                @isset($item['menu'])
                                    <ul class="dropdown-menu">
                                        @foreach ($item['menu'] as $key => $inner)
                                            @if(!isset($inner['access']) || $inner['access'] == false || can($inner['access']))
                                                <li>
                                                    <a href="{{ $inner['url'] }}">
                                                        <span>{{ $inner['name'] }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endisset
                            </li>
                        @endif
                    @endforeach
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span id="theme-name">
                                {{ assets('themes')[user()->theme]['name'] }}
                            </span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach (assets('themes') as $key => $item)
                                <li>
                                    <a class="change-theme"
                                       data-href="{{ $item['href'] }}"
                                       data-name="{{ $item['name'] }}"
                                       data-theme="{{ $key }}">
                                        {{ $item['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> {{ user()->login }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ uri('user/instruction') }}">Посадова інструкція</a></li>
                            <li><a href="{{ uri('schedule/view') }}">Мій графік роботи</a></li>
                            <li>
                                <a data-type="pin_code" href="#" data-href="{{ uri('reports', ['section' => 'my']) }}">
                                    Мої звіти
                                </a>
                            </li>
                            <li><a href="{{ uri('task/main') }}">Мої задачі</a></li>
                            <li><a href="{{ uri('user/profile') }}">Профіль</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('exit') }}">Вихід</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="pjax-container">
        <div class="content-page">
            @isset($breadcrumbs)
                <ol class="breadcrumb">
                    <li><a href="@uri('/')"><i class="fa fa-dashboard"></i></a></li>
                    @foreach ($breadcrumbs as $item)
                        @if ($loop->last)
                            <li class="active"><span>{{ $item[0] }}</span></li>
                        @else
                            <li><a href="{{ $item[1] }}">{{ $item[0] }}</a></li>
                        @endif
                    @endforeach
                </ol>
            @endisset

            @yield('content')

            <div class="scripts-hidden">
                @if (isset($controller) && is_file(public_path("js/controllers/$controller.js")))
                    <script src="{{ asset("js/controllers/$controller.js") }}"></script>
                @endisset

                <script>
                    @if(is_file(public_path('js/Reinitiable.js')))
                        {!! file_get_contents(public_path('js/Reinitiable.js')) !!}
                    @else
                        alert('Reinitiable failed')
                    @endif
                </script>
            </div>
        </div>
    </div>
</div>
</body>
</html>
