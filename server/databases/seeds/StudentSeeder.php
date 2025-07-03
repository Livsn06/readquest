<?php

declare(strict_types=1);


use Phinx\Seed\AbstractSeed;

class StudentSeeder extends AbstractSeed
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
        $students = [
            [
                'id'         => '21-UR-0001',
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'email'      => 'johndoe@example.com',
                "password"   => password_hash('password', PASSWORD_DEFAULT),
            ],
            [
                'id'         => '21-UR-0002',
                'first_name' => 'Jane',
                'last_name'  => 'Doe',
                'email'      =>  null,
            ],
            [
                'id'         => '21-UR-0003',
                'first_name' => 'Karen',
                'last_name'  => 'VaLee',
                'email'      =>  null,
            ],
            [
                'id'         => '21-UR-0004',
                'first_name' => 'Alice',
                'last_name'  => 'Smith',
                'email'      => 'alice@example.com',
            ],

            [
                'id'         => '21-UR-0005',
                'first_name' => 'Robert',
                'last_name'  => 'Starman',
                'email'      => 'robert@example.com',
                'phone'      => '09' . rand(100000000, 999999999),
            ],
        ];


        $this->table('students')->insert($students)->saveData();
    }
}
