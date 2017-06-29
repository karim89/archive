<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model {

	use SoftDeletes;

	protected $table = "languages";
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

}

?>