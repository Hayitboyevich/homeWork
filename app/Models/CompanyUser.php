<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;

    protected $table = 'company_users';

    protected $fillable = ['country_id', 'user_id', 'date'];

    public $timestamps = false;

}
