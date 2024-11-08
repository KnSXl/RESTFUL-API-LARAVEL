<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tb_user';

    protected $primaryKey = 'cd_user';

    protected $fillable = ['ds_name', 'ds_email', 'ds_password'];

    protected $hidden = ['ds_password'];

    const CREATED_AT = 'dt_created';
    const UPDATED_AT = 'dt_updated';
}
