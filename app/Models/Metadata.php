<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metadata extends Model {

	use SoftDeletes;

	protected $table = "metadatas";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\Source');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function record()
    {
        return $this->belongsTo('App\Models\Record');
    }

    public function media()
    {
        return $this->belongsTo('App\Models\Media');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function security()
    {
        return $this->belongsTo('App\Models\Security');
    }

    public function crawls()
    {
        return $this->hasMany('App\Models\Crawl');
    }

    public function crawl()
    {
        return $this->hasOne('App\Models\Crawl');
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