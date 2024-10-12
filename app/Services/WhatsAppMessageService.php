<?php

namespace App\Services;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * WhatsAppMessageService handles sending WhatsApp messages via the Inboxino API.
 *
 * This class encapsulates the logic for constructing and sending a request to
 * the Inboxino API service. It allows sending predefined messages to a list of
 * recipients using the WhatsApp platform.
 *
 * @property Request $request  The HTTP request instance containing user input (e.g., message text).
 * @property string  $apiToken The API token used for authenticating requests to the Inboxino service.
 * @property string  $apiUrl   The URL of the Inboxino API server.
 *
 * @method sendMessage()        Sends a WhatsApp message to the predefined recipients.
 * @method prepareRequestData() Prepares and returns the request data structure needed for the API call.
 * @method getMessage()         Retrieves the message content from the user input in the request.
 * @method setApiToken()        Sets the API token required for authenticating requests.
 * @method setApiServerUrl()    Sets the URL of the API server for sending messages.
 * @method requestToInboxino()  Sends a POST request to the Inboxino API with the prepared data.
 */
class WhatsAppMessageService
{
    private $request;
    private $apiToken;
    private $apiUrl;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function sendMessage(): StreamInterface
    {
        $this->setApiToken();
        $this->setApiServerUrl();

        $requestData = $this->prepareRequestData();
        $response = $this->requestToInboxino($requestData);

        return $response->getBody();
    }

    private function prepareRequestData(): array
    {
        return [
            "messages" => [
                [
                    "message"         => $this->getMessage(),
                    "message_type"    => "message",
                    "attachment_file" => "",
                ],
            ],
            "recipients" => ["09356624033", "09115006079", "09337533195", "09335251871"],
            "platforms"  => ["whatsapp"],
            "setting"    => [
                "expired_minutes" => "",
            ],
            "with_country_code" => true,
            "country_code"      => "+98"
        ];
    }

    private function getMessage(): string
    {
        return $this->request->input('message');
    }

    private function setApiToken(): void
    {
        $this->apiToken = 'inbox-tk.LCeDgqLpmpsRRH5wiP7RlgwnRg7UVHZuwDayJjBDyWrsUWCaUefCP4hHKcrJNxx5hOsGATSeGWhszNai';
    }

    private function setApiServerUrl(): void
    {
        $this->apiUrl = 'https://back.inboxino.com/api/access-api/message/send';
    }

    private function requestToInboxino(array $requestData): ResponseInterface
    {
        $client = new Client();

        return $client->post($this->apiUrl, [
            'headers' => [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'api-token'     => $this->apiToken,
                'Authorization' => 'Bearer ' . $this->apiToken
            ],
            'json'    => $requestData
        ]);
    }


}
