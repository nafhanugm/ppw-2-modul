<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
    {
        $content = [
            'name' => 'Ini Nama Pengirim',
            'subject' => 'Ini subject email',
            'body' => 'Ini adalah isi email yang
dikirim dari laravel 10'
        ];
        Mail::to('shudowsurf@gmail.com')->send(new SendEmail($content));
        return "Email berhasil dikirim.";
    }
}
