<?php

return [
    'NEW' => 'Нове повідомлення, ще не було відправлено',
    'ENQUEUD' => 'Минуло модерацію і поставлено в чергу на відправку',
    'ACCEPTD' => 'Відправлено з системи і прийнято оператором для подальшої пересилки одержувачу',
    'UNDELIV' => 'Не доставлено одержувачу',
    'REJECTD' => 'Відхилено оператором по одній з безлічі причин - неправильний номер одержувача, заборонений текст і т.д.',
    'PDLIVRD' => 'Не всі сегменти повідомлення доставлено одержувачу, деякі оператори повертають звіт тільки про перший доставленому сегменті, тому таке повідомлення після закінчення терміну життя перейде в статус Доставлено',
    'DELIVRD' => 'Доставлено одержувачу повністю',
    'EXPIRED' => 'Доставка не вдалася так як закінчився термін життя повідомлення (за замовчуванням 3 доби)',
    'DELETED' => 'Вилучено з-за обмежень і не доставлено до одержувача',
];