<?php

use SlimStarter\Base\Model;

class Recipe extends Model {

    protected $table = 'recipe';
    protected $fillable = ['title', 'clip', 'point', 'mistake', 'member_id'];
}
