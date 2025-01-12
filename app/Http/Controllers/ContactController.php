<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;  // Use the form request for validation
use App\Mail\ContactFormMail;  // Import the mailable class
use Illuminate\Support\Facades\Mail;  // Import Mail facade
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

class ContactController extends Controller
{
    public $contactData;
    /**
     * Show the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('contact');  // Render the contact form view
    }

    /**
     * Handle the contact form submission.
     *
     * @param ContactFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForm(Request $request)
    {
        // Prepare the contact data to pass to the mailable
        $contactData = $request->only('name', 'email', 'message');

        // Send the email using the ContactFormMail mailable
        Mail::to('gustemans@gmail.com')->send(new ContactFormMail($contactData));

        // Redirect back to the contact form with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent!');
    }
}

