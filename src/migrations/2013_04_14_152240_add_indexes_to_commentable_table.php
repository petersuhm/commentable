<?php

use Illuminate\Database\Migrations\Migration;

class AddIndexesToCommentableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('petersuhm_commentable_comments', function($table)
		{
			$table->index('authorable_id');
			$table->index('authorable_type');
			$table->index('commentable_id');
			$table->index('commentable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('petersuhm_commentable_comments', function($table)
		{
			$table->dropIndex('petersuhm_commentable_comments_authorable_id_index');
			$table->dropIndex('petersuhm_commentable_comments_authorable_type_index');
			$table->dropIndex('petersuhm_commentable_comments_commentable_id_index');
			$table->dropIndex('petersuhm_commentable_comments_commentable_type_index');
		});
	}

}