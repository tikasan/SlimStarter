<?php

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {

    protected $table = 'recipe';
    protected $fillable = ['title', 'clip', 'point', 'mistake', 'member_id'];
}
