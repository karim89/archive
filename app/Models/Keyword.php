<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model {

	use SoftDeletes;

	protected $table = "keywords";
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
	
}

?>