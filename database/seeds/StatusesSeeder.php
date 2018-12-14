<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Status::create(['name'=>'Done']);
        \App\Status::create(['name'=>'cancelled']);
        \App\Status::create(['name'=>'new']);
    }
}
