<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main(){
        // if (auth()->user()->role_id == 1){
        //     return redirect(to:'/maneger');
        // }
        return redirect(to: '/dashboard'); //view('welcome');
    }
    public function dashboard()
    {
        return view('dashboard')->with([
            'applications' => Application::latest()->paginate(5),
        ]);
    }
    //
}
