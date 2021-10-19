<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration {
	
	protected $table = 'blog_posts';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if( !Schema::hasTable($this->table)) {
			Schema::create($this->table, function (Blueprint $table) {
				$table->increments('id');
				$table->string('title');
				$table->text('description');
				$table->text('content');
				$table->string('image');
				$table->unsignedInteger('blog_category_id');
				$table->timestamp('published_at')->nullable();
				$table->softDeletes();
				$table->timestamps();
				$table->foreign('blog_category_id')->references('id')->on('blog_categories');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('blog_posts');
	}
}
