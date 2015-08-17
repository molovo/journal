<?php

Route::group( [ 'prefix' => 'journal' ], function() {
  Route::get( '/', function() {
    return view( 'journal::layouts.dashboard' );
  } );

  Route::resource( 'posts', 'PostsController' );
} );

