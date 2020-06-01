<?php
return [
    '1' => [
        'name'          => 'Наложений платіж за все платить отримувач',
        // Форма оплати imposed | on_the_card
        // для другого пункта немаэ прописаної логіки
        'form_delivery' => 'imposed',

        // Доставку оплачує
        // Отримувач - recipient
        // Відправник - sender
        'pay_delivery'  => 'Recipient',

        // Тип зворотньої доставки
        // none - Немає
        // remittance - Грошовий переказ
        'type'          => 'remittance',

        // Платник зворотньої доставки
        // sender - Відправник
        // receiver - Отримувач
        'payer'         => 'Recipient',

        'id' => 1
    ],
    '2' => [
        'name'          => 'За доставку ми, грошовий переказ отримувач',
        'form_delivery' => 'imposed',
        'pay_delivery'  => 'Sender',
        'type'          => 'remittance',
        'payer'         => 'Recipient',
        'id'            => 2
    ],
    '3' => [
        'name'          => 'За доставку і грошовий переказ плптимо ми',
        'form_delivery' => 'imposed',
        'pay_delivery'  => 'Sender',
        'type'          => 'remittance',
        'payer'         => 'Sender',
        'id'            => 3
    ],
    '4' => [
        'name'          => 'Наложений платіє, за доставку - отримувач, грошовий переказ - ми',
        'form_delivery' => 'imposed',
        'pay_delivery'  => 'Recipient',
        'type'          => 'remittance',
        'payer'         => 'Sender',
        'id'            => 4
    ],
    '5' => [
        'name'          => 'Оплата на карту, за доставку платимо ми',
        'form_delivery' => 'on_the_card',
        'pay_delivery'  => 'Sender',
        'type'          => 'none',
        'payer'         => 'none',
        'id'            => 5
    ],
    '6' => [
        'name'          => 'Оплата на карту, за доставку платить отримувач',
        'form_delivery' => 'on_the_card',
        'pay_delivery'  => 'Recipient',
        'type'          => 'none',
        'payer'         => 'none',
        'id'            => 6
    ],
    '7' => [
        'name' => 'Адресна доставка(інший варіант)'
    ]
];