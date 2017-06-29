<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model {

	use SoftDeletes;

	protected $table = "schedules";
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

    public function frecuency()
    {
        return $this->belongsTo('App\Models\Frecuency');
    }

    public function proccess()
    {
        return $this->belongsTo('App\Models\Proccess');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

}

?>