<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordRequest extends Model
{
    protected $table = "password_requests";
    public $primaryKey = "id";
}
