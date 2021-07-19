<?php

    /* GUEST ROUTES */

	Route::get('/fairgame', ['as' => 'fairgame', 'uses' => 'FairController@Fair']);