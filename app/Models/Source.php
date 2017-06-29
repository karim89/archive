<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model {

	use SoftDeletes;

	protected $table = "sources";
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

    public function metadatas()
    {
        return $this->hasMany('App\Models\Metadata');
    }

    public function metadata()
    {
        return $this->hasOne('App\Models\Metadata');
    }

}

?>