<?php

use App\OrderState;
use Illuminate\Database\Seeder;

class OrderStatesSeeder extends Seeder
{
    private $statesNames = [
        'Не согласован',
        'Согласован',
        'Выполнен',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statesNames as $name){

            $state = new OrderState();
            $state->name = $name;
            $state->save();

        }
    }
}
