<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){

            Siswa::insert([
                [
                    'user_id' => $faker->unique()->numberBetween($min = 1, $max = 50),
                    'nama_depan' => $faker->name,
                    'nama_belakang' => $faker->lastName,
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'agama' => $faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
                    'alamat' => $faker->address,
                ]
            ]);
        }
    }
}
