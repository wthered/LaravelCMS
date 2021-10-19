<?php

namespace App\Models;

use App\Http\Controllers\CategoriesCtrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class blogPost extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = array(
		'title',
		'description',
		'content',
		'image',
		'published_at',
		'blog_category_id',
	);
	
	protected $table = 'blog_posts';

	public function deleteImage(): bool {
		return Storage::delete($this->image);
	}

	public function category(): BelongsTo {
		return $this->belongsTo(CategoriesCtrl::class);
	}
	
	public function tags() {
		return $this->belongsToMany(Tag::class);
	}
	
	public function hasTag($tagID) {
		return in_array($tagID, $this->tags->pluck('id')->toArray());
	}
}
