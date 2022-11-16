<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public $country = 'Canada';

    public function index()
    {
        $users =  User::with('companies', 'companyUser')
        ->whereHas('companies.country' , function ($query){
            $query->where('name', $this->country);
        }
        )->get()->toArray();

        dd($users);
    }
}
