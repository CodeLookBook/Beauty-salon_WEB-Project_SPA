<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderState\CreateRequest;
use App\Http\Requests\OrderState\UpdateRequest;
use App\Order;
use App\OrderState;
use Illuminate\Http\Request;

class OrderStateController extends Controller
{

    public function list  ()
    {

        $states = OrderState::all();

        return response()->json(compact('states'));

    }

    public function create(CreateRequest $request)
    {

        $orderStatus = new OrderState();
        $orderStatus->name = $request->input('name');
        $orderStatus->save();

    }

    public function read(OrderState $orderState)
    {

        return response()->json(compact('orderState'));

    }

    public function update(UpdateRequest $request, OrderState $orderState)
    {

        $orderState->name = $request->input('name');
        $orderState->save();

    }

    public function delete(OrderState $orderState)
    {

        $orderState->delete();

    }

    public function trashedList()
    {

        $states = OrderState::onlyTrashed()->get();
        return response()->json(compact('states'));

    }


    public function trashedRead(OrderState $orderState)
    {

        return response()->json(compact('orderState'));

    }

    public function restoreTrashed(OrderState $orderState)
    {

            $orderState->restore();

    }

    public function trashedDelete(OrderState $orderState)
    {

        $orderState->forceDelete();

    }

}
