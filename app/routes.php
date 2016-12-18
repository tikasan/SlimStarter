<?php

/** default routing */
Route::get('/', 'HomeController:index');
Route::resource('/recipe', 'RecipeController');
Route::resource('/mypage', 'MypageController');