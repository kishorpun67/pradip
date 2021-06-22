<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Contact;
use Session;
use Mail;

class ContactController extends Controller
{
    public function contact(Request $request, $id=null)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $contact = Contact::find($id);
            $contact->address = $data['address'];
            $contact->mobile = $data['mobile'];
            $contact->hotline = $data['hotline'];
            $contact->email = $data['email'];
            $contact->save();
            return redirect()->back()->with('success_message','Conatct has been has updated successfully');
        }

        $contact = Contact::first();
        Session::flash('page', 'contact');
        return view('admin.contact.contact', compact('contact'));
    }

    public function userRquest(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $validator = $request->validate([
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'email' => 'required|email',
                'subject' => 'required|min:10',
                'message' => 'required|min:100',

            ]);

            $adminEamil = "codemaster890@gmail.com";
            $messageData = [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'comment'=>$data['message'],

            ];
            Mail::send('emails.enquiry', $messageData, function($message)use($adminEamil){
                $message->to($adminEamil)->subject('Enquiry Form - E-com Website');
            });
            return redirect()->back()->with('success_message', 'Thanks for your enquiry.  We will get back to you soon.');
        }

        $contact = Contact::first();
        $path = "Get In Touch" ;
        $breadcrumb = "<a  href='/'>Home >  </a>"."Contact";

        // meta tags
        $meta_title = "Contac Us E-shop Sample Website";
        $meta_keywords="contact us, quires";
        $meta_description ="Contact us for any quries related to our product";

        return view('front.contact.contact', compact('breadcrumb','path','contact','meta_title','meta_description','meta_keywords'));
    }

}
