<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property mixed id
 * @property mixed user_id
 * @property mixed token
 * @property mixed code
 */
class PasswordReset extends Model
{
    protected $table = 'password_resets';
    protected $fillable = ['user_id','token','code'];
}
