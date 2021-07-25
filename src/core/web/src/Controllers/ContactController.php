<?php

namespace Web\Controllers;

use Cms\Models\Contact;
use Illuminate\Http\Request;
use Web\Controllers\AppController;

class ContactController extends AppController
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'content' => 'required',
            ]);

            $contact = new Contact();
            $contact->name = $validated['name'];
            $contact->phone = $validated['phone'];
            $contact->email = $validated['email'];
            $contact->content = $validated['content'];
            $contact->save();

            return redirect()->route('contact.index')->with('success', 'Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ phản hồi sớm nhất.');

        }

        $this->setSEO([
            'title' => trans('web::label.contact'),
            'url' => route('contact.index'),
        ]);

        return view('web::pages.contact.index');
    }
}
