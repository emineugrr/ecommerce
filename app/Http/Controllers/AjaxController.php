<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ContentFormRequest;

class AjaxController extends Controller
{
    public function contactsave(ContentFormRequest $request){

      /*  $validationdata = $request ->validate([
            'name'=> 'required|string|min:3',
        'email'=> 'required|email',
        'subject'=> 'required',
        'message'=> 'required'
    ],[
        'name.required'=>'Filling in name and surname is mandatory',
        'name.string'=>'The first and last name should consist of characters.',
        'name.min'=>'First and last name must be at least 3 characters long.',
        'email.required'=>'Filling email is mandatory.',
        'email.email'=>'Invalid email addresses.',
        'subject.required'=>'Subject space cannot be null.',
        'message.required'=>'Message space cannot be null',
    ]);

     /* $data=$request->all();
      $data['ip']= request()->ip();
*/

    $newdata=[
        'name'=> Str::title($request->name),
        'email'=>$request->name,
        'subject'=>$request->subject,
        'message'=>$request->message,
        'ip'=>request()->ip(),
    ];

     $lastsaved= Contact::create($newdata);

     return back()->with(['message'=>'Sended successfully!']);


    }
}
