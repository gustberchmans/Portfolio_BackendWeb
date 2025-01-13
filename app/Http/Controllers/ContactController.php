<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;  // Use the form request for validation
use App\Mail\ContactFormMail;  // Import the mailable class
use Illuminate\Support\Facades\Mail;  // Import Mail facade
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\Models\Contact;
use App\Mail\ContactReplyMail;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('status', 'Your message has been submitted.');
    }

    public function index()
    {
        $contacts = Contact::all(); // or apply any filtering you need
        return view('admin.contacts.index', compact('contacts'));
    }

    public function reply(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Send reply via email
        Mail::raw($validated['reply_message'], function ($message) use ($contact) {
            $message->to($contact->email)
                ->subject("Reply to your contact request");
        });

        // Mark as answered
        $contact->update(['answered_at' => now()]);

        return redirect()->route('admin.contacts.reply')->with('status', 'Reply sent successfully.');
    }

    public function sendReply(Request $request, Contact $contact)
    {
        // Validate the response
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        // Send the reply via email
        \Mail::to($contact->email)->send(new \App\Mail\ContactReplyMail($contact, $request->response));

        // Update the contact message with the answer
        $contact->answered_at = now();  // Set the time when the message was answered
        $contact->save();  // Save the contact message with the updated info

        // Redirect with success message
        return redirect()->route('admin.contacts.index')->with('status', 'Reply sent successfully.');
    }

    public function showReplyForm(Contact $contact)
    {
        return view('admin.contacts.reply', compact('contact'));
    }

}

