<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model {

	use SoftDeletes;

	protected $table = "searches";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function logo()
    {
        return $this->belongsTo('App\Models\Logo');
    }

    public function clicks()
    {
        return $this->hasMany('App\Models\Click');
    }

    public function click()
    {
        return $this->hasOne('App\Models\Click');
    }

}

?>