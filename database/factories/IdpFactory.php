<?php

namespace Database\Factories;

use App\Models\Competency;
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
        $comp = Competency::find(fake()->randomElement([1,2,3,4,14]));
        $comp1 = Competency::find(fake()->randomElement([5,6,7,8]));
        $comp2 = Competency::find(fake()->randomElement([9,10,11,12,13]));
        return [
            
            'user_id' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
            'purpose_meet' => fake()->randomElement([' ', '/']),
            'purpose_improve' => fake()->randomElement([' ', '/']),
            'purpose_obtain' => fake()->randomElement([' ', '/']),
            'purpose_others' => fake()->randomElement([' ', '/']),
            'purpose_explain' => fake()->randomElement([' ', '/']),
            'competency' => [$comp->competency_name,$comp1->competency_name,$comp2->competency_name],
            'sug' => [fake()->randomElement(['S','U','G']),fake()->randomElement(['S','U','G']),fake()->randomElement(['S','U','G'])],
            'dev_act' => [fake()->sentence(),fake()->sentence(),fake()->sentence()],
            'target_date' => [fake()->date(),fake()->date(),fake()->date()],
            'responsible' => [fake()->randomElement(['Immediate Supervisor', 'VPAA','VPAF','VPRE']),fake()->randomElement(['Immediate Supervisor', 'VPAA','VPAF','VPRE']),fake()->randomElement(['Immediate Supervisor', 'VPAA','VPAF','VPRE'])],
            'support' => ["December ". date('Y') + 1,"December ". date('Y') + 1,"December ". date('Y') + 1],
            'status' => ["Ongoing","Ongoing","Ongoing"],
            'compfunction0' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'compfunctiondesc0' => fake()->sentence(),
            'compfunction1' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'compfunctiondesc1' => fake()->sentence(),
            'diffunction0' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'diffunctiondesc0' => fake()->sentence(),
            'diffunction1' => fake()->randomElement(['Core', 'Functional','LeaderShip']).' - '. fake()->word(),
            'diffunctiondesc1' => fake()->sentence(),
            'career' => fake()->sentence(),
            'year' => date('Y') + 1,
            'submit_status' => 'Pending'
        ];
    }
    
}
