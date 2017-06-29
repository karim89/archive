<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exclusion extends Model {

	use SoftDeletes;

	protected $table = "exclusions";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function crawl()
    {
        return $this->belongsTo('App\Models\Crawl');
    }

    public function metadata()
    {
        return $this->belongsTo('App\Models\Metadata');
    }

    public function format()
    {
        return $this->belongsTo('App\Models\Format');
    }

}

?>