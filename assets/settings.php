<?php

use App\Models\Attribute;
use App\Models\BlackDate;
use App\Models\Characteristic;
use App\Models\Logistic;
use App\Models\Merchant;
use App\Models\OrderHint;
use App\Models\OrderProfessional;
use App\Models\Pay;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\Site;
use App\Models\Street;

return [
    'hints' => [
        'title'  => 'Підказки',
        'model'  => OrderHint::class,
        'fields' => [
            'color'       => [
                'type'    => 'color',
                'title'   => 'Колір',
                'display' => function ($value) {
                    return "<span style='display: inline-block; width: 50px; height: 25px; background-color: $value'>$value</span>";
                }
            ],
            'description' => [
                'type'  => 'text',
                'title' => 'Текст'
            ],
            'type'        => [
                'type'    => 'select',
                'title'   => 'Показувати в',
                'options' => OrderHint::getTypes()
            ]
        ]
    ],

    'delivery' => [
        'title'  => 'Логістичні компанії',
        'model'  => Logistic::class,
        'fields' => [
            'name' => [
                'type'  => 'text',
                'title' => 'Назва'
            ]
        ]

    ],

    'pay' => [
        'title'  => 'Оплата',
        'model'  => Pay::class,
        'fields' => [
            'name'        => [
                'type'  => 'text',
                'title' => 'Назва'
            ],
            'merchant_id' => [
                'type'    => 'select',
                'title'   => 'Мерчант',
                'options' => Merchant::all()->mapWithKeys(function (Merchant $merchant) {
                    return [$merchant->id => $merchant->name];
                })
            ],
            'provider'    => [
                'type'  => 'text',
                'title' => 'Постачальик',
            ],
            'address'     => [
                'type'  => 'text',
                'title' => 'Адреса',
            ],
            'ipn'         => [
                'type'  => 'text',
                'title' => 'ІПН',
            ],
            'account'     => [
                'type'  => 'text',
                'title' => 'Розрахунковий рахунок',
            ],
            'bank'        => [
                'type'  => 'text',
                'title' => 'Банк',
            ],
            'mfo'         => [
                'type'  => 'text',
                'title' => 'МФО',
            ],
            'phone'       => [
                'type'  => 'text',
                'title' => 'Тел./факс',
            ],
            'director'    => [
                'type'  => 'text',
                'title' => 'Директор',
            ],
            'is_cashless' => [
                'type'  => 'boolean',
                'title' => 'Безготівковий розрахунок',
            ],
            'is_pdv'      => [
                'type'  => 'boolean',
                'title' => 'Являється платником податків'
            ],
        ]
    ],

    'attributes' => [
        'title'  => 'Атрибути',
        'model'  => Attribute::class,
        'fields' => [
            'name' => [
                'title' => 'Назва',
                'type'  => 'localize'
            ]
        ]
    ],

    'order_professional' => [
        'title'  => 'Типи професійних замовлень',
        'model'  => OrderProfessional::class,
        'fields' => [
            'name'  => [
                'type'  => 'text',
                'title' => 'Назва'
            ],
            'color' => [
                'type'  => 'color',
                'title' => 'Колір'
            ]
        ]
    ],

    'sites' => [
        'title'  => 'Сайти',
        'model'  => Site::class,
        'fields' => [
            'name' => [
                'title' => 'Назва',
                'type'  => 'text'
            ],
            'url'  => [
                'title' => 'Url',
                'type'  => 'url'
            ]
        ]
    ],

    'merchants' => [
        'title'   => 'Мерчанти',
        'model'   => Merchant::class,
        'child'   => 'merchant_cards',
        'fields'  => [
            'name'        => [
                'title' => 'Назва(для списку)',
                'type'  => 'text'
            ],
            'password'    => [
                'type'  => 'text',
                'title' => 'Пароль(з пб)'
            ],
            'merchant_id' => [
                'type'  => 'text',
                'title' => 'Ідентифікатор(пб)'
            ]
        ],
        'hasMany' => [
            'cards' => [
                'title'  => 'Карточки',
                'fields' => [
                    'number' => [
                        'title' => 'Номер карти',
                        'type'  => 'text'
                    ]
                ]
            ]
        ]
    ],

    'shops' => [
        'title'  => 'Магазини',
        'model'  => Shop::class,
        'fields' => [
            'name'     => [
                'type'     => 'localize',
                'title'    => 'Назва',
                'required' => true
            ],
            'address'  => [
                'type'     => 'localize',
                'title'    => 'Адреса',
                'required' => true
            ],
            'url_path' => [
                'type'  => 'url',
                'title' => 'Адреса маршруту(URL)'
            ]
        ]
    ],

    'characteristics' => [
        'title'  => 'Характеристики',
        'model'  => Characteristic::class,
        'fields' => [
            'name'    => [
                'title'    => 'Назва',
                'type'     => 'localize',
                'required' => true
            ],
            'prefix'  => [
                'title' => 'Префікс',
                'type'  => 'localize',
            ],
            'postfix' => [
                'title' => 'Постфікс',
                'type'  => 'localize',
            ],
            'value'   => [
                'title' => 'Значення',
                'type'  => 'localize',
            ],
            'type'    => [
                'title'   => 'Тип',
                'type'    => 'select',
                'options' => Characteristic::getTypes()
            ]
        ]
    ],

    'black_dates' => [
        'title'  => 'Чорні дати',
        'model'  => BlackDate::class,
        'fields' => [
            'date' => [
                'type'     => 'date',
                'title'    => 'Дата',
                'required' => true
            ],
            'name' => [
                'type'  => 'text',
                'title' => 'Назва'
            ]
        ]
    ],

    'streets' => [
        'title'    => 'Вулиці',
        'model'    => Street::class,
        'paginate' => 100,
        'fields'   => [
            'street_type' => [
                'filter'  => true,
                'type'    => 'select',
                'title'   => 'Тип обєкта',
                'options' => [
                    'Вулиця'    => 'Вулиця',
                    'Провулок'  => 'Провулок',
                    'Площа'     => 'Площа',
                    'Узвіз'     => 'Узвіз',
                    'Проспект'  => 'Проспект',
                    'Бульвар'   => 'Бульвар',
                    'Шосе'      => 'Шосе',
                    'Дорога'    => 'Дорога',
                    'Проїзд'    => 'Проїзд',
                    'Алея'      => 'Алея',
                    'Набережна' => 'Набережна',
                    'Тупик'     => 'Тупик',

                ]
            ],
            'name'        => [
                'filter' => true,
                'type'   => 'text',
                'title'  => 'Назва'
            ],
            'district'    => [
                'filter'   => true,
                'type'     => 'text',
                'title'    => 'Район',
                'required' => true
            ],
        ]
    ],

    'settings' => [
        'title'    => 'Глобальні перемінні',
        'model'    => Setting::class,
        'paginate' => 100,
        'fields'   => [
            'key'   => [
                'type'     => 'text',
                'title'    => 'Ключ',
                'disabled' => true,
            ],
            'value' => [
                'type'  => 'text',
                'title' => 'Значення'
            ]
        ]
    ]
];