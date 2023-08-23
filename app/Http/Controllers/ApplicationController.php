<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);
        $name = null;
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $name = $file->getClientOriginalName();

            //$file->move(public_path().'/uploads/', $name);
        }
        Application::create([
          'subject' => $request->subject,
          'message' => $request->message,
            'file' => $name,
        ]);

        // Application::create([

        // ]);

    }
    //
}
