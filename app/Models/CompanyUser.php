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


    public function companies()
    {
        $this->hasMany(Company::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
