<?php

namespace Database\Factories;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokterFactory extends Factory
{
    protected $model = Dokter::class;

    public function definition()
    {
        return [
            'sip' => $this->faker->unique()->numerify('########'),
            'nama_dokter' => $this->faker->name,
            'spesialis' => $this->faker->word,
            'foto_dokter' => '1729444704.png',
            'jadwal' => json_encode([
                ['hari' => 'Senin', 'sesi' => 'Pagi'],
                ['hari' => 'Selasa', 'sesi' => 'Siang'],
            ]),
        ];
    }
}
