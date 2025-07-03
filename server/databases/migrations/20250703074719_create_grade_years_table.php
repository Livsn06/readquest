<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateGradeYearsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $table = $this->table('grade_years');

        $table->addColumn('year_level', 'integer', [
            'default' => null,
            'limit' => 1,
            'null' => false,
            'signed' => false
        ])
            ->addTimestamps()
            ->addIndex(
                ['year_level'],
                [
                    'unique' => true,
                ]
            );

        $table->create();
    }

    public function down(): void
    {
        $this->table('grade_years')->drop()->update();
    }
}
