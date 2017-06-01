<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public $service=[
        "Укладка",
        "Маникюр",
        "Педикюр",
        "Лечебная процедура для волос",
        "Массаж",
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->service as $name){
            $service = new Service();
            $service->name = $name;
            $service->save();
        }
    }
}
