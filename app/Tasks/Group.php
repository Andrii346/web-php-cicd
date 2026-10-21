<?php

declare(strict_types=1);

namespace App\Tasks;

class Group
{
    /**
     * @param  Student[]  $students
     */
    public function __construct(
        public int $groupId,
        public string $name,
        public array $students = []
    ) {}

    public function addStudent(Student $student): void
    {
        $this->students[$student->id] = $student;
    }

    public function removeStudent(int $id): bool
    {
        if (isset($this->students[$id])) {
            unset($this->students[$id]);

            return true;
        }

        return false;
    }

    /**
     * @return Student[]
     */
    public function searchStudent(string $name): array
    {
        return array_filter($this->students, function (Student $student) use ($name): bool {
            return mb_stripos($student->name, $name) !== false || mb_stripos($student->surname, $name) !== false;
        });
    }
}
