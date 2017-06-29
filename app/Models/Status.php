<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model {

	use SoftDeletes;

	protected $table = "statuses";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function metadatas()
    {
        return $this->hasMany('App\Models\Metadata');
    }

    public function metadata()
    {
        return $this->hasOne('App\Models\Metadata');
    }

    public function crawls()
    {
        return $this->hasMany('App\Models\Crawl');
    }

    public function crawl()
    {
        return $this->hasOne('App\Models\Crawl');
    }

    public function filters()
    {
        return $this->hasMany('App\Models\Filter');
    }

    public function filter()
    {
        return $this->hasOne('App\Models\Filter');
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