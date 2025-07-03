<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePersonalAccessTokenTable extends AbstractMigration
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
        $table = $this->table('personal_access_tokens');


        //User ID or the ID of the model that owns the token (e.g., student ID).
        $table->addColumn('tokenable_id', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false
        ])
            //The actual JWT string or hashed token. Used to verify or revoke tokens.
            ->addColumn('token', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => false
            ])
            //The type/class name that owns the token (e.g., 'Student', 'Admin').
            ->addColumn('tokenable_type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false
            ])

            //A label for the token (e.g., 'Chrome on Mac', 'Mobile Login').
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false
            ])

            //JSON array or comma-separated string of allowed actions (e.g., 'read,write').
            ->addColumn('abilities', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false
            ])

            //When the token should expire — used for validating active sessions.
            ->addColumn('expires_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])

            //Tracks last time token was used for auditing or session tracking.
            ->addColumn('last_used_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => true
            ])


            //When the token was created — for auditing and management.
            ->addTimestamps();

        $table->create();
    }

    public function down(): void
    {
        $this->table('personal_access_tokens')->drop()->update();
    }
}
