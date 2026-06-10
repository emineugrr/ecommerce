<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Str;
use App\Http\Requests\ContentFormRequest;

class AjaxController extends Controller
{

    public function contactsave(ContentFormRequest $request)
    {
        $newdata = [
            'name'    => Str::title($request->name),
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip'      => request()->ip(),
        ];

        Contact::create($newdata);

        
        return back()->with('success', 'Message sent successfully!');
    }
}
