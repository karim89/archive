<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warc extends Model {

	use SoftDeletes;

	protected $table = "warcs";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function medadata()
    {
        return $this->belongsTo('App\Models\Metadata');
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\Models\Thumbnail');
    }

    public function crawl()
    {
        return $this->belongsTo('App\Models\Crawl');
    }

    public function filter()
    {
        return $this->belongsTo('App\Models\Filter');
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