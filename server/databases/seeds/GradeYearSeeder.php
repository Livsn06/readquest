<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class GradeYearSeeder extends AbstractSeed
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

        $gradeYears = [];

        for ($i = 4; $i <= 6; $i++) {
            $gradeYears[] = [
                'year_level' => $i,
            ];
        }

        $this->table('grade_years')->insert($gradeYears)->save();
    }
}
