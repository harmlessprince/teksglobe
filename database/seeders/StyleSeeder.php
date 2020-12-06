<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Style;
use Database\Factories\StyleFactory;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $datas = [
            ['name' => 'Yearly', 'compound' => 1],
            ['name' => 'Daily', 'compound' => 24],
            ['name' => 'Weekly', 'compound' => 168],
            ['name' => 'Monthly', 'compound' => 720],
            ['name' => 'Yearly', 'compound' => 8760],
        ];

        foreach ($datas as $data) {

            Style::create([
                'name' => $data['name'],
                'compound' => $data['compound']
            ])->each(function ($style) {
                $style->plans()->saveMany(
                    Plan::factory(1)->make(['style_id' => null])
                );
            });
        }
    }
}
