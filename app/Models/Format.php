<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Format extends Model {

	use SoftDeletes;

	protected $table = "formats";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function exclusions()
    {
        return $this->hasMany('App\Models\Exclusion');
    }

    public function exclusion()
    {
        return $this->hasOne('App\Models\Exclusion');
    }

}

?>