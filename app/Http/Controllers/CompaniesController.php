<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public $country = 'Uzbekistan';

    public function index()
    {

//        $query = Country::with(['companies'])->where('name', $country)->get();
//        dd($query);


//        $query = User::with('companies.country')
//            ->select('*', 'c.name as country_name', 'cu.created_at as company_worked_at')
//            ->join('company_users as cu', 'cu.user_id', '=', 'users.id')
//            ->join('companies as cm', 'cm.id', '=', 'cu.company_id')
//            ->join('countries as c', 'c.id', '=', 'cm.country_id')
//            ->where('c.name', 'like', 'Can%')
//            ->get()
//            ->toArray();

//        $users = User::with(['companies' => function ($query) {
//            $query->with(['country' => function ($_query) {
//                $_query->where('name', $this->country);
//            }]);
//        }])
//            ->get()
//            ->toArray();

        $users = User::whereHas(
            'companies.country' , function ($query){
                $query->where('name', 'Uzbekistan');
            }
        )->with('companies.country')->get()->toArray();
        dd($users);
        return view('');
    }
}
