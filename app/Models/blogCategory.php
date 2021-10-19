<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogCategory extends Model
{
    use HasFactory;
	protected $fillable = ['name'];
	
	public function posts() {
		return $this->hasMany(blogPost::class);
	}
}
