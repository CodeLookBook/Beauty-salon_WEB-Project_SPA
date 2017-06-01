<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Order;
use App\OrderState;
use App\Service;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth; //TODO: delete if dosn't uses

class OrderController extends Controller
{

    public function list            (            ){

        $list = Order::all();

        return response()->json($list);

    }
    public function count           (            ){

        $count = Order::count();

        return \response()->json(['count'=>$count]);

    }
    public function range           ($startDate, $endDate){

        $startDate  = Carbon::createFromFormat('d.m.Y', $startDate)->
                              format('Y-m-d 00:00:00');
        $endDate    = Carbon::createFromFormat('d.m.Y', $endDate )->
                              format('Y-m-d 00:00:00');

        $orders = Order::whereBetween('date',[$startDate, $endDate])->
                        latest('date')->orderBy('time')->with('customer', 'service', 'state')->get();


        return \response()->json( compact('orders') );

    }

    public function create          (CreateRequest $request ){

        $r = $request;

        //Retrieve Service model from DB
        $s = Service::find($r->input('order.service.id'));

        //Retrieve State model from DB
        $os = OrderState::find($r->input('order.state.id'));

        //Create and Save to DB new Order info
        $o = new Order();

        $o->date = $r->input('order.date');
        $o->time = $r->input('order.time');
        $o->service()->associate($s);
        $o->state()->associate($os);

        $o->save();

        //Create and save to DB new Customer info
        $c = new Customer();
        $c->name  = $r->input('order.customer.name');
        $c->phone = $r->input('order.customer.phone');
        $c->order()->associate($o);
        $c->save();

    }
    public function read            (Order         $order   ){

        return response()->json(compact('order', 200));

    }
    public function update          (UpdateRequest $request, Order $order){

        $r=$request;
        $o=$order;

        //Retrieve new Order data from request
        $name       =$r->has('order.customer.name' )? trim($r->input('order.customer.name' )) : null;
        $phone      =$r->has('order.customer.phone')? trim($r->input('order.customer.phone')) : null;
        $service_id =$r->has('order.service.id'    )? trim($r->input('order.service.id'    )) : null;
        $state_id   =$r->has('order.state.id'      )? trim($r->input('order.state.id'      )) : null;
        $date       =$r->has('order.date'          )? trim($r->input('order.date'          )) : null;
        $time       =$r->has('order.time'          )? trim($r->input('order.time'          )) : null;

        //Make changes in order
        if(!empty($name      )) $o->customer->name = $name;
        if(!empty($phone     )) $o->customer->phone = $phone;
        if(!empty($service_id)) $o->service()->associate(Service::find($service_id));
        if(!empty($state_id  )) $o->state()->associate(OrderState::find($state_id));
        if(!empty($date      )) $o->date = $date;
        if(!empty($time      )) $o->time = $time;

        //Save changes
        if(!empty($name ) || !empty($phone)) $o->customer->save();
        $o->save();

    }
    public function delete          (Order         $order   ){
        $order->delete();
    }

    public function trashedList     ($startDate, $endDate   ){

        $startDate  = Carbon::createFromFormat('d.m.Y', $startDate)->
                              format('Y-m-d 00:00:00');
        $endDate    = Carbon::createFromFormat('d.m.Y', $endDate )->
                              format('Y-m-d 00:00:00');

        $orders = Order::onlyTrashed()->whereBetween('date',[$startDate, $endDate])->
                         latest('date')->orderBy('time')->with('customer', 'service', 'state')->
                         get();

        return \response()->json( compact('orders') );

    }
    public function trashedCount    (            ){

        $count = Order::onlyTrashed()->count();

        return \response()->json(['count'=>$count]);

    }
    public function trashedRange    ($startDate, $endDate){

        $startDate  = Carbon::createFromFormat('d.m.Y', $startDate)->
                              format('Y-m-d 00:00:00');
        $endDate    = Carbon::createFromFormat('d.m.Y', $endDate  )->
                              format('Y-m-d 00:00:00');

        $orders = Order::onlyTrashed()->whereBetween('date',[$startDate, $endDate])->
                        latest('date')->orderBy('time')->
                        with('customer', 'service')->get();

        return \response()->json(compact('orders'));

    }

    public function readTrashed     (Order $order){
        return response()->json($order, 200);
    }
    public function restoreTrashed  (Order $order){
        $order->restore();
    }
    public function deleteTrashed   (Order $order){
        $order->forceDelete();
    }

}
