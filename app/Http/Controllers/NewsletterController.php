<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function checkSubscriber(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            // $data = json_decode(json_encode($data));
            $subscriberCount = NewsletterSubscriber::where('email', $data['subscriber_email'])->count();
            if($subscriberCount >0) {
                echo "exists";
            }
        }
    }

    public function addSubscriber(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            // $data = json_decode(json_encode($data));
            $subscriberCount = NewsletterSubscriber::where('email', $data['subscriber_email'])->count();
            if($subscriberCount >0) {
                echo "exists";
            }else{
                // add newsletter email  in newsletter_subscribers  tabel
                $newsletter = new NewsletterSubscriber;
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 1;
                $newsletter->save();
                echo "save";
            }
        }
    }


}
