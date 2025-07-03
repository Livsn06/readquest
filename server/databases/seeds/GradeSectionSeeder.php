<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class GradeSectionSeeder extends AbstractSeed
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
        $sections = [];

        for ($i = 1; $i <= 3; $i++) {
            $sections[] = [
                'section_name' => 'Section ' . $i,
            ];
        }

        $this->table('grade_sections')->insert($sections)->save();
    }
}
