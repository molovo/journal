<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateJournalPackage extends Migration
{

    public function __construct()
    {
        // Get the prefix
        $this->prefix = Config::get('journal.prefix');
        $this->admin_prefix = Config::get('admin.prefix');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $prefix       = $this->prefix;
        $admin_prefix = $this->admin_prefix;

        Schema::create( $prefix.'posts', function ( Blueprint $table ) {
            // Product Info
            $table->increments( 'id' );
            $table->integer( 'status' )->unsigned();
            $table->string('name');
            $table->longtext( 'description' );
            $table->longtext( 'content' );

            // Link To
            $table->integer( 'category_id' )->unsigned()->index();
            $table->foreign( 'category_id' )->references( 'id' )->on( $prefix.'post_categories' )->onDelete( 'cascade' );
            $table->integer( 'author_id' )->unsigned()->index()->nullable();
            $table->foreign( 'author_id' )->references( 'id' )->on( $admin_prefix.'users' );

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        } );

        Schema::create( $prefix.'post_images', function( Blueprint $table ) {
            // Image Info
            $table->increments( 'id' );
            $table->string( 'caption' );
            $table->string( 'alt_text' );
            $table->integer( 'sequence' )->unsigned();

            // Link To
            $table->integer( 'post_id' )->unsigned()->index();
            $table->foreign( 'post_id' )->references( 'id' )->on( $prefix.'posts' )->onDelete( 'cascade' );

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        } );

        Schema::create( $prefix.'post_categories', function( Blueprint $table ) {
            // Category Info
            $table->incerements( 'id' );
            $table->integer( 'status' )->unsigned();
            $table->string( 'name' );
            $table->longtext( 'description' );

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'posts' );
        Schema::drop( 'post_images' );
        Schema::drop( 'post_categories' );
    }
}
