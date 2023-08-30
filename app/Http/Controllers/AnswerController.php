<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleChecker:manager')->only('store','create');
    }
    public function create(Application $application){
        if (auth()->user()->cannot('store')){
        abort(403);
    }
        return view('answer.create',['application'=>$application]);
    }
    public function store( Application $application, Request $request){
        if (auth()->user()->cannot('store')){
            abort(403);
        }
        $request->validate([
            'message' =>'required'
        ]);
        $application->answer()->create([
            'body' => $request->message,
        ]);
        return redirect()->route('dashboard');

    }
    //
}
