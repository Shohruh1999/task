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
            'subject' => 'required | max: 255',
            'message' => 'required',
        ]);
        $name = null;
        if ($request->hasFile('file')){
           $validate = $request->validate(['file' => 'file|mimes:pdf,jpg,jpeg|max: 4000']);
           dd($validate);
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $path = $request->file('file')->storeAs(
                'files',
                $name,
                'public'
            );
            //$file->move(public_path().'/uploads/', $name);
        }
       $application = Application::create([
          'subject' => $request->subject,
          'message' => $request->message,
            'file_url' => $path ?? null
        ]);
        return redirect()->back();
    }
    //
}
