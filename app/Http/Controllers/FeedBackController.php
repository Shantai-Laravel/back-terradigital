<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\FeedBack;
use App\Models\PromocodeType;
use App\Models\Promocode;
use Session;


class FeedBackController extends Controller
{
    public function index()
    {
        return view('front.pages.thanks');
    }

    public function proposesBook(Request $request)
    {
        $data['name'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['contact_message'] = $request->get('message');

        $to = 'iovitatudor@gmail.com';

        $feedback = new FeedBack();
        $feedback->first_name = request('name');
        $feedback->email = request('email');
        $feedback->subject = 'Proposes a book';
        $feedback->message = request('message');
        $feedback->status = 'new';

        $feedback->save();

        Mail::send('mails.contactForm.admin', $data, function($message) use ($to){
            $message->to($to, 'Proposes a book')->from('contactmessage@gmail.com')->subject('Proposes a book');
        });

        Session::flash('message', 'Va multumim, in scrut timp managerii nostri va vor contacta.');
        return redirect()->back();
    }

    public function contactFeedBack(Request $request)
    {
        $data['name'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['contact_message'] = $request->get('message');

        $to = 'iovitatudor@gmail.com';

        $feedback = new FeedBack();
        $feedback->first_name = request('name');
        $feedback->email = request('email');
        $feedback->phone = request('phone');
        $feedback->subject = 'FAQ';
        $feedback->message = request('message');
        $feedback->status = 'new';

        $feedback->save();

        Mail::send('mails.contactForm.admin', $data, function($message) use ($to){
            $message->to($to, 'Contactează-ne')->from('contactmessage@gmail.com')->subject('Contact Us.');
        });

        // $email = $request->get('email');
        //
        // Mail::send('mails.contactForm.user', $data, function($message) use ($email){
        //     $message->to($email, 'You left a message on the online shop juliaallert.com')->from('julia.allert.fashion@gmail.com')->subject('You left a message on the online shop juliaallert.com');
        // });

        Session::flash('message', 'Va multumim, in scrut timp managerii nostri va vor contacta.');
        return redirect()->back();
    }
}
