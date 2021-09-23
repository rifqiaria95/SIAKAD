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
                    'nisn' => $faker->randomNumber,
                    'nama_depan' => $faker->firstName,
                    'nama_belakang' => $faker->lastName,
                    'tempat_lahir' => $faker->city,
                    'tanggal_lahir' => $faker->date,
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'nama_ibu' => $faker->name($gender = 'female'),
                    'nama_ayah' => $faker->name($gender = 'male'),
                    'agama' => $faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
                    'user_id' => $faker->unique()->numberBetween($min = 1, $max = 500),
                    'kelas_id' => $faker->unique()->numberBetween($min = 1, $max = 500),
                    'jurusan_id' => $faker->unique()->numberBetween($min = 1, $max = 500),
                    'alamat' => $faker->address,
                ]
            ]);
        }
    }
}
