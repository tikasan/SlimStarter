<?php

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    protected $table = 'member';
    protected $fillable = ['name', 'img_url', 'mail', 'login_id', 'password', 'pos_code', 'address'];
}