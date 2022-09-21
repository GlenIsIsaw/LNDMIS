<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Competency;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         Competency::create([
             'competency_group' => 'Core', 
             'competency_name' => 'Exemplifying integrity and professionalism',
             'teaching' => 1,
             'nonteaching' => 1,
         ]);
         Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Delivering services excellent',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Solving Problems and Making Decisions',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Thinking Strategically and Creatively',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Initiatives for Improvement',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Customer Focus',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);



        //Functional

        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'ICT Skills/Computer Skills',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);

        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Teaching for Independent Training',
            'teaching' => 1,
            'nonteaching' => 0,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Managing Conducive Learning Environment',
            'teaching' => 1,
            'nonteaching' => 0,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Searching for New Knowledge',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Transferring New Knowledge to Beneficiaries',
            'teaching' => 1,
            'nonteaching' => 0,
        ]);

        //Leadership
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Managing Performance and Coaching for Results',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Leading/Managing Change',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Building Collaborative and Inclusive Working Relationship',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Creating and Nurturing a High Performance Organization',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);



    }
}
