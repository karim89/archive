<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filter extends Model {

	use SoftDeletes;

	protected $table = "filters";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function metadata()
    {
        return $this->belongsTo('App\Models\Metadata');
    }

    public function crawl()
    {
        return $this->belongsTo('App\Models\Crawl');
    }

    public function security()
    {
        return $this->belongsTo('App\Models\Security');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function warcs()
    {
        return $this->hasMany('App\Models\Warc');
    }

    public function warc()
    {
        return $this->hasOne('App\Models\Warc');
    }

}

?>