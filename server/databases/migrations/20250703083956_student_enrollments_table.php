<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class StudentEnrollmentsTable extends AbstractMigration
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
        $table = $this->table('student_enrollments', [
            'id' => false,
            'primary_key' => [
                'student_id',
                'grade_year_id',
                'section_id',
            ]
        ]);

        $table->addColumn('student_id', 'string', [
            'limit' => 20,
            'null' => false
        ])
            ->addColumn('grade_year_id', 'integer', [
                'null' => true,
                'signed' => false,
                'default' => null
            ])
            ->addColumn('section_id', 'integer', [
                'null' => true,
                'signed' => false,
                'default' => null
            ])
            ->addColumn('school_year', 'string', [
                'limit' => 20,
                'null' => false
            ])
            ->addColumn('enrollment_status', 'enum', [
                'values' => ['enrolled', 'pending', 'dropped'],
                'default' => 'enrolled',
                'null' => false
            ])
            ->addColumn('deleted_at', 'datetime', [
                'null' => true
            ])
            ->addTimestamps()
            ->addForeignKey('student_id', 'students', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('grade_year_id', 'grade_years', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('section_id', 'grade_sections', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }

    public function down(): void
    {
        $this->table('student_enrollments')->drop()->save(); // Use save() instead of update() after drop()
    }
}
