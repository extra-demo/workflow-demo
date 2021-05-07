<?php

namespace Database\Factories;

use App\Models\TiAn;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TiAnFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TiAn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'marking' => null,
            'remark' => null,
            'uploaded' => 0,
        ];
    }
}
