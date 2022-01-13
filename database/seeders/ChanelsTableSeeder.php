<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Channel;

class ChanelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'General',
            'slug' => Str::slug('General')
        ]);
        Channel::create([
            'name' => 'Urgent',
            'slug' => Str::slug('Urgent')
        ]);
        Channel::create([
            'name' => 'Special',
            'slug' => Str::slug('Special')
        ]);
        Channel::create([
            'name' => 'Others',
            'slug' => Str::slug('Others')
        ]);
    }
}
