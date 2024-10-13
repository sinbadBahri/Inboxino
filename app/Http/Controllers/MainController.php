<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppMessageService\WhatsAppMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class MainController extends Controller
{
    private WhatsAppMessageService $whatsAppMessenger;

    public function __construct(WhatsAppMessageService $whatsAppMessageService)
    {
        $this->whatsAppMessenger = $whatsAppMessageService;
    }

    public function index(): InertiaResponse
    {
        return Inertia::render(component: 'Home');
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $response = $this->whatsAppMessenger->sendMessage($request);

        return response()->json(['success' => true, 'data' => $response]);
    }
}
