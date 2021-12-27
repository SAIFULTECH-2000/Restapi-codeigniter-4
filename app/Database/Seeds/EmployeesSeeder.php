<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class EmployeesSeeder extends Seeder
{
    public function run()
    {
       for ($i = 0; $i < 10; $i++) { 
			//to add 10 users. Change limit as desired
            $this->db->table('employees')->insert($this->generateEmployees());
        }
    }
    private function generateEmployees(): array
    {
        $faker = Factory::create();
        return [
            'name' => $faker->name(),
            'email' => $faker->email,
            'phone_no' =>$faker->phoneNumber(),
        ];
    }
}
