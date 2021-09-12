<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_depan' => $faker->name,
            'nama_belakang' => $faker->lastName,
            'jenis_kelamin' => $faker->randomElement(['L', 'P']),
            'agama' => $faker->randomElement(['Islam', 'Kristen', 'Budha', 'Hindu']),
            'alamat' => $faker->address,
        ];
    }
}
