<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppMessageService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Http\Message\StreamInterface;

class MainController extends Controller
{

    private  $whatsAppMessenger;

    public function __construct(WhatsAppMessageService $whatsAppMessageService)
    {
        $this->whatsAppMessenger = $whatsAppMessageService;
    }

    public function index(): View
    {
        return view('index');
    }


    public function sendMessage(Request $request): StreamInterface
    {
        return $this->whatsAppMessenger->sendMessage();
    }
}
