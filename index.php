<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/app/Services/EntityService.php';
require_once __DIR__.'/app/Services/DataProcessor.php';

use App\Services\DataProcessor;
use App\Services\EntityService;
use Faker\Factory;

$entityService = new EntityService;
$dataProcessor = new DataProcessor;
$faker = Factory::create('uk_UA');

?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота №3 - Основи PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 25px;
            background: #f4f6f9;
            color: #333;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #1a365d;
        }

        h2 {
            color: #2b6cb0;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 8px;
        }

        .error {
            color: #c53030;
            font-weight: bold;
        }

        .finally {
            color: #2c5282;
            font-style: italic;
        }

        code {
            background: #edf2f7;
            padding: 2px 6px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Лабораторна робота №3: Основи PHP</h1>
    <p><a href="app/Models/EntityArray.php" target="_blank">Перейти до Завдання 1 (Масиви в EntityArray.php) &rarr;</a></p>

    <!-- Завдання 2 -->
    <div class="card">
        <h2>Завдання 2. Користувацькі функції зі строгою типізацією</h2>
        <?php
        $gross = 32000.00;
$taxRate = 19.5; // 18% ПДФО + 1.5% ВЗ
$net = $entityService->calculateNetSalary($gross, $taxRate);
?>
        <p>Нарахована зарплата (Gross): <strong><?= number_format($gross, 2) ?> грн</strong></p>
        <p>Сукупний податок: <strong><?= $taxRate ?>%</strong></p>
        <p>Чиста заробітна плата (Net): <strong><?= number_format($net, 2) ?> грн</strong></p>
    </div>

    <!-- Завдання 3 -->
    <div class="card">
        <h2>Завдання 3. Faker та анонімна функція (Closure) з фільтрацією</h2>
        <?php
$salaries = [];
for ($i = 0; $i < 10; $i++) {
    $salaries[] = $faker->numberBetween(14000, 50000);
}

$minThreshold = 30000;

// Використання анонімної функції та use ($minThreshold)
$highSalaries = array_filter($salaries, function (int $salary) use ($minThreshold): bool {
    return $salary >= $minThreshold;
});
?>
        <p>Згенеровані оклади співробітників (10 значень Faker):</p>
        <p><code><?= implode(', ', $salaries) ?> грн</code></p>
        <p>Поріг фільтрації: <strong>>= <?= $minThreshold ?> грн</strong></p>
        <p>Відфільтровані високі зарплати:</p>
        <p><strong><?= implode(', ', $highSalaries) ?> грн</strong></p>
    </div>

    <!-- Завдання 4 -->
    <div class="card">
        <h2>Завдання 4. Обробка винятків (try-catch-finally)</h2>
        <?php
$baseAmount = 25000.0;
$invalidDiscount = 150.0; // Некоректне значення
?>
        <p>Спроба надати знижку/пільгу <strong><?= $invalidDiscount ?>%</strong> для суми <?= $baseAmount ?> грн:</p>
        <?php
try {
    $res = $entityService->applyDiscount($baseAmount, $invalidDiscount);
    echo "<p>Результат: {$res} грн</p>";
} catch (Exception $e) {
    echo "<p class='error'>Перехоплено виняток: ".htmlspecialchars($e->getMessage()).'</p>';
} finally {
    echo "<p class='finally'>Блок finally: Спроба розрахунку завершена (ресурс звільнено).</p>";
}
?>
    </div>

    <!-- Завдання 5 (Варіант: 2, 6, 1) -->
    <div class="card">
        <h2>Завдання 5. Індивідуальні алгоритмічні завдання (2, 6, 1)</h2>

        <!-- Задача з Табл. 3.2, №2 -->
        <h3>1. Вставка нуля після кожного додатного елемента (Табл. 3.2, №2)</h3>
        <?php
$initialArray = [5, -3, 12, 0, -8, 7, -1];
$modifiedArray = $dataProcessor->insertZeroAfterPositives($initialArray);
?>
        <p>Початковий масив: <code>[<?= implode(', ', $initialArray) ?>]</code></p>
        <p>Перетворений масив: <strong>[<?= implode(', ', $modifiedArray) ?>]</strong></p>

        <!-- Задача з Табл. 3.3, №6 -->
        <h3>2. Кількість слів на приголосну букву (Табл. 3.3, №6)</h3>
        <?php
$sampleText = "Бухгалтер нараховує аванс та оплачує щомісячні податкові зобов'язання";
$consonantCount = $dataProcessor->countWordsStartingWithConsonant($sampleText);
?>
        <p>Вхідний рядок: <em>"<?= htmlspecialchars($sampleText) ?>"</em></p>
        <p>Знайдено слів, що починаються з приголосної: <strong><?= $consonantCount ?></strong></p>

        <!-- Задача з Табл. 3.4, №1 -->
        <h3>3. Пошук максимального числа в рядку (Табл. 3.4, №1)</h3>
        <?php
$numbersString = '125 48 992 14 1050 320 74';
$maxNumber = $dataProcessor->findMaxNumberInString($numbersString);
?>
        <p>Рядок із числами: <code><?= htmlspecialchars($numbersString) ?></code></p>
        <p>Максимальне число: <strong><?= $maxNumber ?></strong></p>
    </div>
</body>

</html>