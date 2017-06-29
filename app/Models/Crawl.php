<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crawl extends Model {

	use SoftDeletes;

	protected $table = "crawls";
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

    public function hop()
    {
        return $this->belongsTo('App\Models\Hop');
    }

    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function exclusions()
    {
        return $this->hasMany('App\Models\Exclusion');
    }

    public function exclusion()
    {
        return $this->hasOne('App\Models\Exclusion');
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