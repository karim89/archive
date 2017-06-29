<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logo extends Model {

	use SoftDeletes;

	protected $table = "logos";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function searches()
    {
        return $this->hasMany('App\Models\Logo');
    }

    public function sources()
    {
        return $this->hasMany('App\Models\Source');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Subcategory');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }

}

?>