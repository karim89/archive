<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Security extends Model {

	use SoftDeletes;

	protected $table = "securities";
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

    public function filters()
    {
        return $this->hasMany('App\Models\Filter');
    }

    public function filter()
    {
        return $this->hasOne('App\Models\Filter');
    }

}

?>