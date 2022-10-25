<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idp>
 */
class IdpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        return [
            'user_id' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
            'purpose_meet' => fake()->randomElement([' ', '/']),
            'purpose_improve' => fake()->randomElement([' ', '/']),
            'purpose_obtain' => fake()->randomElement([' ', '/']),
            'purpose_others' => fake()->randomElement([' ', '/']),
            'purpose_explain' => fake()->randomElement([' ', '/']),
            'competency' => [fake()->word(),fake()->word(),fake()->word()],
            'sug' => [fake()->randomElement(['S','U','G']),fake()->randomElement(['S','U','G']),fake()->randomElement(['S','U','G'])],
            'dev_act' => [fake()->sentence(),fake()->sentence(),fake()->sentence()],
            'target_date' => [fake()->date(),fake()->date(),fake()->date()],
            'responsible' => [fake()->word(),fake()->word(),fake()->word()],
            'support' => [fake()->sentence(),fake()->sentence(),fake()->sentence()],
            'status' => ["Completed","Completed","Completed"],
            'compfunction0' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'compfunctiondesc0' => fake()->sentence(),
            'compfunction1' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'compfunctiondesc1' => fake()->sentence(),
            'diffunction0' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'diffunctiondesc0' => fake()->sentence(),
            'diffunction1' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'diffunctiondesc1' => fake()->sentence(),
            'career' => fake()->sentence(),
            'submit_status' => 'Approved'
        ];
    }
    
}
