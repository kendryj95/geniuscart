<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['country_id','city_name','slug','status'];
    public $timestamps = false;

    public function neigh()
    {
    	return $this->hasMany('App\Models\Neighborhood')->where('status','=',1);
    }

    public function country()
    {
    	return $this->belongsTo('App\Models\Country')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }

}
