<?php

use App\Customer;
use App\Order;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{

    private $customers=null;

    function __construct (){
        $this->customers= array(
            ['name'=>'Света' ,'phone'=>'0635234516'],
            ['name'=>'Коля'  ,'phone'=>'0981115555'],
            ['name'=>'Валя'  ,'phone'=>'0983322255'],
            ['name'=>'Дима'  ,'phone'=>'0678884445'],
            ['name'=>'Сергей','phone'=>'0556663332'],
            ['name'=>'Аня'   ,'phone'=>'0679994443'],

            ['name'=>'Люся'  ,'phone'=>'0555555555'],
            ['name'=>'Костя' ,'phone'=>'0335656588'],
            ['name'=>'Саша'  ,'phone'=>'4548869965'],
            ['name'=>'Вова'  ,'phone'=>'0235656868'],
            ['name'=>'Алла'  ,'phone'=>'0656506565'],
            ['name'=>'Таня'  ,'phone'=>'0656898989'],

            ['name'=>'Мила'  ,'phone'=>'0665656565'],
            ['name'=>'Ольга' ,'phone'=>'0334848797'],
            ['name'=>'Тамара','phone'=>'4543235334'],
            ['name'=>'Юля'   ,'phone'=>'0235745451'],
            ['name'=>'Оля'   ,'phone'=>'0654564654'],
            ['name'=>'Мира'  ,'phone'=>'0654546352'],
        );
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 1;
        foreach($this->customers as $data){
            $customer = new Customer();
            $customer->name = $data['name'];
            $customer->phone = $data['phone'];
            $order = Order::find($counter);
            $order->customer()->save($customer);
            ++$counter;
        }
    }
}
