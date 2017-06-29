<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Click extends Model {

	use SoftDeletes;

	protected $table = "clicks";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function search()
    {
        return $this->belongsTo('App\Models\Search');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function metadata()
    {
        return $this->belongsTo('App\Models\Metadata');
    }

    public function warc()
    {
        return $this->belongsTo('App\Models\Warc');
    }

}

?>