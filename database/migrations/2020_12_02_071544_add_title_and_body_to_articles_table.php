<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndBodyToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'articles',
            function (Blueprint $table) {
                if (!Schema::hasColumn('articles', 'title')) {
                    Schema::table('articles', function (Blueprint $table) {
                        $table->string('title', 200)->nullable();
                    });
                }
                if (!Schema::hasColumn('articles', 'body')) {
                    Schema::table('articles', function (Blueprint $table) {
                        $table->text('body')->nullable();
                    });
                }
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'articles',
            function (Blueprint $table) {
                if (Schema::hasColumn('articles', 'title')) {
                    Schema::table('articles', function (Blueprint $table) {
                        $table->dropColumn('title');
                    });
                }
                if (Schema::hasColumn('articles', 'body')) {
                    Schema::table('articles', function (Blueprint $table) {
                        $table->dropColumn('body');
                    });
                }
            }
        );
    }
}
