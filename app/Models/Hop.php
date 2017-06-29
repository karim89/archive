<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hop extends Model {

	use SoftDeletes;

	protected $table = "hops";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function crawls()
    {
        return $this->hasMany('App\Models\Crawl');
    }

    public function crawl()
    {
        return $this->hasOne('App\Models\Crawl');
    }

}

?>