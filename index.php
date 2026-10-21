<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use App\Core\Database;
use App\Core\EntityFactory;
use App\Services\ConsoleLogger;
use App\Services\EntityService;
use App\Tasks\Exam;
use App\Tasks\FinalExam;
use App\Tasks\Group;
use App\Tasks\Rectangle;
use App\Tasks\Student;
use App\Tasks\TestTrial;

$db1 = Database::getInstance();
$db2 = Database::getInstance();
$isSameInstance = ($db1 === $db2);

$user = EntityFactory::createEntity('user', [
    'id' => 'USR-001',
    'name' => 'Андрій Бухгалтер',
    'email' => 'andriy@company.com',
    'role' => 'Головний бухгалтер',
]);

$product = EntityFactory::createEntity('product', [
    'id' => 'PRD-777',
    'title' => 'Програмний модуль Зарплата PRO',
    'price' => 12500.00,
    'stock' => 15,
]);

$jsonOutput = method_exists($user, 'exportToJson') ? $user->exportToJson() : '{}';

$logger = new ConsoleLogger;
$service = new EntityService($logger);

ob_start();
$service->processEntity($user);
$service->calculateNetSalary(35000.0, 19.5);
$logOutputs = ob_get_clean();

$group = new Group(101, 'ІПЗ-21');
$s1 = new Student(1, 'Іван', 'Франко', '1995-08-27');
$s2 = new Student(2, 'Леся', 'Українка', '1996-02-25');
$s3 = new Student(3, 'Тарас', 'Шевченко', '1994-03-09');

$group->addStudent($s1);
$group->addStudent($s2);
$group->addStudent($s3);

$searchResult = $group->searchStudent('Франко');
$group->removeStudent(3);

$test = new TestTrial('Вступний вхідний тест');
$exam = new Exam('Семестровий екзамен з ООП');
$finalExam = new FinalExam('Державний кваліфікаційний випускний іспит');

$rectangle = new Rectangle(12.5, 8.0);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота №4 - ООП та Патерни в PHP</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #f0f2f5; padding: 25px; color: #1c1e21; }
        .card { background: white; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.12); }
        h1 { color: #0d3c61; margin-top: 0; }
        h2 { color: #1a73e8; border-bottom: 2px solid #e8f0fe; padding-bottom: 8px; }
        pre { background: #282c34; color: #abb2bf; padding: 12px; border-radius: 6px; overflow-x: auto; }
        .badge { background: #e6f4ea; color: #137333; padding: 4px 8px; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Лабораторна робота №4: ООП, Архітектура та Патерни в PHP</h1>

    <div class="card">
        <h2>1. Патерн Singleton (Database)</h2>
        <p>Статус: <span class="badge"><?= $db1->getConnectionStatus() ?></span></p>
        <p>Перевірка ідентичності ($db1 === $db2): <strong><?= $isSameInstance ? 'true (Один спільний екземпляр у пам’яті)' : 'false' ?></strong></p>
    </div>

    <div class="card">
        <h2>2. Factory Method та Абстрактні класи</h2>
        <p>Створено сутність User: <code><?= htmlspecialchars($user->getDetails()) ?></code></p>
        <p>Створено сутність Product: <code><?= htmlspecialchars($product->getDetails()) ?></code></p>
    </div>

    <div class="card">
        <h2>3. Інтерфейси та Трейт (JsonExportTrait)</h2>
        <p>Результат експорту об'єкта User у JSON:</p>
        <pre><?= htmlspecialchars($jsonOutput) ?></pre>
    </div>

    <div class="card">
        <h2>4. Dependency Injection (EntityService + ConsoleLogger)</h2>
        <p>Логи виконання методів бізнес-сервісу:</p>
        <pre><?= htmlspecialchars($logOutputs) ?></pre>
    </div>

    <div class="card">
        <h2>5. Індивідуальні завдання (Варіант 1)</h2>
        
        <h3>5.1. Композиція класів: Group та Student (Табл. 4.2, №2)</h3>
        <p>Група: <strong><?= htmlspecialchars($group->name) ?></strong> (ID: <?= $group->groupId ?>)</p>
        <p>Студентів у групі після видалення ID #3: <strong><?= count($group->students) ?></strong></p>
        <p>Результат пошуку за запитом "Франко": 
            <strong>
            <?php foreach ($searchResult as $st) { ?>
                <?= htmlspecialchars($st->getFullName()) ?> (<?= $st->birthday ?>);
            <?php } ?>
            </strong>
        </p>

        <h3>5.2. Ієрархія класів та метод getPassingScore() (Табл. 4.3, №5)</h3>
        <ul>
            <li><?= htmlspecialchars($test->getTitle()) ?> &rarr; Прохідний бал: <strong><?= $test->getPassingScore() ?></strong></li>
            <li><?= htmlspecialchars($exam->getTitle()) ?> &rarr; Прохідний бал: <strong><?= $exam->getPassingScore() ?></strong> (+20 балів)</li>
            <li><?= htmlspecialchars($finalExam->getTitle()) ?> &rarr; Прохідний бал: <strong><?= $finalExam->getPassingScore() ?></strong> (+15 балів)</li>
        </ul>

        <h3>5.3. Інкапсуляція: Rectangle з readonly властивостями (Табл. 4.4, №1)</h3>
        <p>Прямокутник: ширина = <strong><?= $rectangle->width ?></strong>, висота = <strong><?= $rectangle->height ?></strong></p>
        <p>Периметр: <strong><?= $rectangle->getPerimeter() ?></strong></p>
        <p>Площа: <strong><?= $rectangle->getArea() ?></strong></p>
    </div>
</body>
</html>