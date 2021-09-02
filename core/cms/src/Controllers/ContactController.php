<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Contact;
use Cms\Requests\ContactRequest;
use Cms\Mails\ReplyContactMail;
use Cms\Constants;

class ContactController extends AppController
{

    public function save(ContactRequest $request, Contact $contact)
    {
        if ($request->isMethod('post')) {

            $contact->reply_content = $request->input('reply_content');
            $contact->status = Constants::CONTACT_REPLIED;
            $contact->save();

            if ($contact->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            // Send mail to sender
            \Mail::to($contact->email)->send(new ReplyContactMail($contact));

            return redirect()->route('auth.contact.list')->with('success', $message);
        }
        return view('cms::auth.pages.contact.form', compact('contact'));
    }
}
