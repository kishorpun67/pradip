<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsletterSubscriber;
use Session;
use Maatwebsite\Excel\Facades\Excel;
class NewsletteController extends Controller
{

    public function newsLetterSubscriber()
    {
        $newsLettrs = NewsletterSubscriber::get();
        Session::flash('page','newletter');
        return view('admin.newsletter.newsletter_subscribe', compact('newsLettrs'));
    }

    public function updateNewsLetterSubscriber(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            NewsletterSubscriber::where('id', $data['news_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'news_id' =>$data['news_id']]);
        }
    }

    public function deleteNewsletters($id)
    {
        NewsletterSubscriber::where('id',$id)->delete();
        return redirect()->back()->with('success_message', 'Subscriber has been deleted succesfully!');
    }

}
