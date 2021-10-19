<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    use HasFactory;
	protected $fillable = ['name'];
	protected $table = 'tags';
	
	public function posts() {
//		return $this->belongsToMany(blogPost::class, 'post_tag', 'id', 'post_id');
		return $this->belongsToMany(blogPost::class);
	}
}
