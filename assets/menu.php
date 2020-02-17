<?php

return [
    [
        'name'   => 'Панель управління',
        'url'    => uri('/'),
        'access' => false,
        'icon'   => 'dashboard',
    ],
    [
        'name'   => 'Каталог',
        'url'    => '#',
        'access' => false,
        'icon'   => 'book',
        'menu'   => [
            [
                'name'   => 'Закупки',
                'url'    => uri('purchase/main'),
                'access' => 'purchase',
            ],
            [
                'name'   => 'Інвентаризація',
                'url'    => uri('inventory/main'),
                'access' => 'inventory',
            ],
            [
                'name'   => 'Категорії',
                'url'    => uri('category/main'),
                'access' => 'category',
            ],
            [
                'name'   => 'Постачальники',
                'url'    => uri('manufacturer/main'),
                'access' => 'manufacturer',
            ],
            [
                'name'   => 'Товари',
                'url'    => uri('product/main'),
                'access' => 'product',
            ],
            [
                'name'   => 'Активи',
                'url'    => uri('product/assets'),
                'access' => 'product',
            ],
            [
                'name'   => 'Склади',
                'url'    => uri('storage/main'),
                'access' => 'storage',
            ]
        ]
    ],
    [
        'name'   => 'Замовлення',
        'url'    => '#',
        'access' => 'orders',
        'icon'   => 'shopping-basket',
        'menu'   => [
            [
                'name' => 'Доставки',
                'url'  => uri('orders/view', ['type' => 'delivery'])
            ],
            [
                'name' => 'Відправки',
                'url'  => uri('orders/view', ['type' => 'sending'])
            ],
            [
                'name' => 'Самовивози',
                'url'  => uri('orders/view', ['type' => 'self'])
            ],
            [
                'name'   => 'Постійні клієнти',
                'url'    => uri('client/main'),
                'access' => 'client'
            ],
        ]
    ],
    [
        'name'   => 'Інше',
        'url'    => '#',
        'access' => false,
        'icon'   => 'cogs',
        'menu'   => [
            [
                'name'   => 'Налаштування',
                'url'    => uri('settings/main'),
                'access' => 'settings'
            ],
            [
                'name'   => 'Статистика',
                'url'    => uri('statistic'),
                'access' => 'statistic'
            ],
            [
                'name'   => 'Відпустки',
                'url'    => uri('vacation'),
                'access' => 'vacation'
            ],
            [
                'name'   => 'Транзакції',
                'url'    => uri('pb'),
                'access' => 'transactions'
            ],
            [
                'name'   => 'Логи',
                'url'    => uri('log'),
                'access' => 'logs'
            ],
        ]
    ],
    [
        'name'   => 'Менеджери',
        'url'    => uri('user/list'),
        'icon'   => 'users',
        'access' => 'user',
        'menu'   => [
            [
                'name'   => 'Доступ',
                'url'    => uri('access/main'),
                'access' => 'access'
            ],
            [
                'name'   => 'Список',
                'url'    => uri('user/list'),
                'access' => 'ROOT'
            ],
            [
                'name'   => 'Посади',
                'url'    => uri('user/positions'),
                'access' => 'user'
            ],
        ]
    ],
    [
        'name'   => 'Адмін',
        'url'    => '#',
        'icon'   => 'cogs',
        'access' => 'ROOT',
        'menu'   => [
            [
                'name'   => 'PhpMyAdmin',
                'url'    => uri('phpmyadmin/index.php'),
                'access' => 'ROOT'
            ],
            [
                'name'   => 'Файл менеджер',
                'url'    => uri('explorer/index.php'),
                'access' => 'ROOT'
            ],
            [
                'name'   => 'Команди',
                'url'    => uri('commands'),
                'access' => 'ROOT'
            ]
        ]
    ]
];