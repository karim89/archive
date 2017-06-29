<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proccess extends Model {

	use SoftDeletes;

	protected $table = "proccesses";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    public function schedule()
    {
        return $this->hasOne('App\Models\Schedule');
    }

}

?>