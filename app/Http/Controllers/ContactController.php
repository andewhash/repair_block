<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);
      
        // Отправка письма
        Mail::to("noreply@zapfind.ru")->send(new ContactFormMail($validated));

        return back()->with('success', 'Ваше сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.');
    }
}