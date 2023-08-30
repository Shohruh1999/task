<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{
 // public function __construct()
    // {
    //     $this->middleware('roleChecker:manager')->only('store','create');
    // }
    public function create(Application $application){
        if (! Gate::allows('store',auth()->user())){
            abort(404);
        }
        if (auth()->user()->cannot('store')){
        abort(403);
    }
        return view('answer.create',['application'=>$application]);
    }
    public function store( Application $application, Request $request){
        if (! Gate::allows('store',auth()->user())){
            abort(404);
        }
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
