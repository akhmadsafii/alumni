<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;

class MailController extends Controller
{
    public function index()
  {
    $data = [
      "subject"=>"Cambo Tutorial Mail",
      "body"=>"Hello friends, Welcome to Cambo Tutorial Mail Delivery!"
      ];
    // MailNotify class that is extend from Mailable class.
    try
    {
      Mail::to('akhmadsafii96@gmail.com')->send(new MailNotify($data));
      return response()->json(['Great! Successfully send in your mail']);
    }
    catch(Exception $e)
    {
      return response()->json(['Sorry! Please try again latter']);
    }
  }
}
