<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public $country = 'Canada';

    public function index()
    {
        $users =  User::whereHas('companies.country' , function ($query){
            $query->where('name', $this->country);
        })
        ->with('companies', function ($_query){
            $_query->with('country', 'companyUser');
        })
        ->get()->toArray();

        return $users;
    }
}
