<?php

declare(strict_types=1);

$paymentTypes = [
    'Оклад за посадою',
    'Премія за місяць',
    'Лікарняні виплати',
    'Відпускні',
    'Надбавка за вислугу років',
];

sort($paymentTypes);

$employee = [
    'id' => 101,
    'taxNumber' => '3254918234',
    'firstName' => 'Олександр',
    'lastName' => 'Ковальчук',
    'iban' => 'UA823052990000026001234567890',
];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Структури даних - Облік заробітної плати</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        h2 { color: #2c3e50; }
        ul { background: #f8f9fa; padding: 15px 35px; border-radius: 6px; width: fit-content; }
    </style>
</head>
<body>
    <h2>Відсортовані типи виплат (Індексний масив):</h2>
    <ul>
        <?php foreach ($paymentTypes as $type) { ?>
            <li><?= htmlspecialchars($type) ?></li>
        <?php } ?>
    </ul>

    <h2>Дані працівника (Асоціативний масив сутності Employee):</h2>
    <ul>
        <?php foreach ($employee as $key => $value) { ?>
            <li><strong><?= htmlspecialchars((string) $key) ?>:</strong> <?= htmlspecialchars((string) $value) ?></li>
        <?php } ?>
    </ul>
</body>
</html>
