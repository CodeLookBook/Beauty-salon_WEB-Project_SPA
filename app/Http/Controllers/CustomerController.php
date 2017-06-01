<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\Customer\CreateRequest;
use App\Http\Requests\Customer\UpdateRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function range           ($skip, $take           ){

        $range = Customer::skip($skip)->take($take)->get();

        return response()->json($range);

    }
    public function count           (                       ){

        $count = Customer::count();

        return response()->json(['count'=>$count]);

    }
    public function create          (CreateRequest $request ){

        $r = $request;
        $c = new Customer();
        $c->name = $r->input('name');
        $c->phone= $r->input('phone');
        $c->save();

    }
    public function read            (Customer $customer     ){

        return response()->json($customer);

    }
    public function update          (UpdateRequest $request, Customer $customer){

        $r = $request;
        $c = $customer;

        if($r->has('name' )) $c->name  = $r->input('name' );
        if($r->has('phone')) $c->phone = $r->input('phone');

        if($r->has('name') || $r->has('phone')) $c->save();

    }
    public function delete          (Customer $customer     ){

        $customer->delete();

    }

    public function trashedRange    ($skip, $take           ){

        $range = Customer::onlyTrashed()->skip($skip)->take($take)->get();

        return response()->json($range);

    }
    public function trashedCount    (                       ){

        $count = Customer::onlyTrashed()->count();

        return response()->json(['count'=>$count]);

    }
    public function readTrashed     (Customer $customer     ){

        return response()->json($customer);

    }
    public function restoreTrashed  (Customer $customer     ){

        $customer->restore();

    }
    public function deleteTrashed   (Customer $customer     ){

        $customer->forceDelete();

    }

}
