<?php

namespace Database\Seeders;

use App\Models\Guru;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 20; $i++){

            Guru::insert([
                [
                    'user_id' => $faker->unique()->numberBetween($min = 1, $max = 50),
                    'nign' => $faker->randomNumber,
                    'nama_guru' => $faker->name,
                    'tempat_lahir' => $faker->city,
                    'tanggal_lahir' => $faker->date,
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'telepon' => $faker->phoneNumber,
                    'alamat' => $faker->address,
                ]
            ]);
        }
    }
}
