<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CreateRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Service;
use Illuminate\Http\Request;


class ServiceController extends Controller
{

    public function count()
    {

        $count = Service::count();

        return response()->json(['count' => $count]);

    }
    public function list            (                     ){

        $services = Service::all();

        return response()->json(compact('services'));

    }
    public function create          (CreateRequest $request)
    {

        $r = $request;
        $n = $r->input('name');

        $s = new Service();
        $s->name = $this->uc_first($n);
        $s->save();

    }
    public function read            (Service $service){

        return response()->json($service);

    }
    public function update          (UpdateRequest $request, Service $service)
    {

        $r = $request;
        $n = null;

        if($r->has('name')) {
            if(!empty($r->input('name'))){
                if($r->input('name') != 'null'){
                    $n = trim($r->input('name'));
                }
            }
        }

        $s = $service;
        $s->name = $n;

        $s->save();

    }
    public function delete          (Service $service)
    {

        $service->delete();

    }
    public function trashedCount    ()
    {

        $count = Service::onlyTrashed()->count();

        return response()->json(compact('count'));

    }
    public function trashedList    (                ){

        $trashedServices = Service::onlyTrashed()->get();

        return response()->json(compact('trashedServices'));

    }
    public function readTrashed     (Service $trashedServices){

        return response()->json(compact('trashedServices'));

    }
    public function restoreTrashed  (Service $trashedServices){

        $trashedServices->restore();

    }
    public function deleteTrashed   (Service $trashedServices){

        $trashedServices->forceDelete();

    }

    private function uc_first($s){

        if(!is_null($s) || empty($s)){
            $s = mb_strtolower($s);
            $c = mb_substr($s, 0, 1);
            $c = mb_strtoupper($c);

            $l = mb_strlen($s);
            $s = $c . ($l > 1 ? mb_substr($s, 1, $l-1):'');
        }


        return $s;

    }
}
