<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thumbnail extends Model {

	use SoftDeletes;

	protected $table = "thumbnails";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
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