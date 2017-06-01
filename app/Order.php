<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function customer(){
        return $this->hasOne('App\Customer', 'order_id');
    }
    public function service(){
        return $this->belongsTo('App\Service', 'service_id');
    }
    public function state(){
        return $this->belongsTo('App\OrderState', 'state_id');
    }

    public function getDateAttribute($value){
        return Carbon::createFromFormat('Y-m-d H:i:s',
            $value)->format('d.m.Y');
    }

    public function setDateAttribute($value){
        $this->attributes['date'] = Carbon::createFromFormat(
            'd.m.Y',
            $value)->format('Y-m-d 00:00:00');
    }

}
