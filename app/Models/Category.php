<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

	use SoftDeletes;

	protected $table = "categories";
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