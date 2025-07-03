<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateStudentsTable extends AbstractMigration
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
        $table = $this->table('students', [
            'id' => false,
            'primary_key' => ['id'],
        ]);

        $table->addColumn('id', 'string', [
            'limit' => 20
        ])
            ->addColumn('first_name', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('last_name', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('phone', 'string', [
                'limit' => 11,
                'null' => true
            ])
            ->addColumn('email', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('password', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('email_verified_at', 'datetime', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('remember_token', 'string', [
                'limit' => 255,
                'null' => true,
                'default' => null
            ])
            ->addColumn('deleted_at', 'datetime', [
                'null' => true
            ])
            ->addTimestamps()
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['phone'], ['unique' => true])
            ->create();
    }


    public function down(): void
    {
        $this->table('students')->drop()->update();
    }
}
