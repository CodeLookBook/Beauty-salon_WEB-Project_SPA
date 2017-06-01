<?php

use App\Customer;
use App\Order;
use App\OrderState;
use App\Service;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    private $orders = array(
        ['date'=>'07.05.2017', 'time'=>'9:00' , 'state'=>'Не согласован'],
        ['date'=>'29.05.2017', 'time'=>'10:00', 'state'=>'Не согласован'],
        ['date'=>'21.05.2017', 'time'=>'11:00', 'state'=>'Согласован'],
        ['date'=>'13.05.2017', 'time'=>'12:00', 'state'=>'Согласован'],
        ['date'=>'12.05.2017', 'time'=>'13:00', 'state'=>'Не согласован'],
        ['date'=>'06.05.2017', 'time'=>'14:00', 'state'=>'Не согласован'],

        ['date'=>'24.05.2017', 'time'=>'10:00', 'state'=>'Выполнен'],
        ['date'=>'24.05.2017', 'time'=>'11:00', 'state'=>'Выполнен'],
        ['date'=>'24.05.2017', 'time'=>'12:00', 'state'=>'Не согласован'],
        ['date'=>'24.05.2017', 'time'=>'13:00', 'state'=>'Не согласован'],
        ['date'=>'24.05.2017', 'time'=>'14:00', 'state'=>'Выполнен'],
        ['date'=>'24.05.2017', 'time'=>'15:00', 'state'=>'Выполнен'],

        ['date'=>'07.05.2017', 'time'=>'11:00', 'state'=>'Согласован'],
        ['date'=>'29.05.2017', 'time'=>'12:00', 'state'=>'Согласован'],
        ['date'=>'24.05.2017', 'time'=>'13:00', 'state'=>'Не согласован'],
        ['date'=>'13.05.2017', 'time'=>'14:00', 'state'=>'Не согласован'],
        ['date'=>'12.05.2017', 'time'=>'15:00', 'state'=>'Согласован'],
        ['date'=>'06.05.2017', 'time'=>'16:00', 'state'=>'Согласован'],
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->orders as $data){

            $service = Service::all()->random();
            $state = OrderState::where('name',$data['state'])->first();

            $order = new Order();
            $order->date = $data['date'];
            $order->time = $data['time'];
            $order->state()->associate($state);
            $order->service()->associate($service);
            $order->state()->associate($state);
            $order->save();

        }
    }
}
