<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class StudentEnrollmentSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        // Fetch existing students, sections, and grade years
        $students = $this->fetchAll('SELECT id FROM students');
        $sections = $this->fetchAll('SELECT id FROM grade_sections');
        $gradeYears = $this->fetchAll('SELECT id FROM grade_years');

        $enrollments = [];

        foreach ($students as $student) {
            $gradeYear = $gradeYears[array_rand($gradeYears)];
            $section = $sections[array_rand($sections)];

            $enrollments[] = [
                'student_id' => $student['id'],
                'grade_year_id' => $gradeYear['id'],
                'section_id' => $section['id'],
                'school_year' => '2024-2025',
                'enrollment_status' => 'enrolled'
            ];
        }

        $this->table('student_enrollments')->insert($enrollments)->saveData();
    }
}
