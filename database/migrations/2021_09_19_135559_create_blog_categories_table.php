<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration {
	
	protected $table = 'blog_categories';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    	if( !Schema::hasTable($this->table)) {
		    Schema::create($this->table, function (Blueprint $table) {
			    $table->increments('id');
			    $table->string('name')->unique();
			    $table->timestamps();
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
        Schema::dropIfExists('blog_categories');
    }
}
