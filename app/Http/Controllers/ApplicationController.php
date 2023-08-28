<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $day = Carbon::now()->format('Y-m-d');

        $data = auth()->user()->applications()->max('id');
        if ($data != null) {
            $app= Application::find($data)->created_at->format('Y-m-d') ;
            if ($day == $app) {
              //  dd("mk");
                return redirect()->back()->with('error', 'You have already applied for this day');
            }
        }
        $request->validate([
            'subject' => 'required | max: 255',
            'message' => 'required',
        ]);
        $name = null;
        if ($request->hasFile('file')){
           $validate = $request->validate(['file' => 'file|mimes:pdf,jpg,jpeg|max: 4000']);
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
            'user_id' => auth()->user()->id,
          'subject' => $request->subject,
          'message' => $request->message,
            'file_url' => $path ?? null,
        ]);


        dispatch(new SendEmailJob($application));
// dd('ishladi');
   //     Mail::to($request->user())->send(new ApplicationCreated($application));
        return redirect()->back();
    }
    //
}
