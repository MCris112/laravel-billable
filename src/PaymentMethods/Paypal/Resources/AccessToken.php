<?php

namespace MCris112\Billable\PaymentMethods\Paypal\Resources;

use Illuminate\Support\Facades\Http;
use MCris112\Billable\Exceptions\Providers\Paypal\PaypalAccessTokenException;
use MCris112\Billable\PaymentMethods\Paypal\PaypalMethod;

class AccessToken
{
    private array $scopes;
    private string $access_token;

    private string $token_type = "Bearer";

    private string $app_id;

    private int $expires_in;


    public function __construct()
    {
        $request = Http::withHeaders([
            "Authorization" => 'Basic '.$this->parseCredentials(),
            "Accept" => "application/json"
        ])->asForm()->post( PaypalMethod::URL("v1/oauth2/token"), [ "grant_type" => "client_credentials"] );

        if($request->badRequest() || isset($request->json()["error"])) throw new PaypalAccessTokenException();

        $this->parseResponse($request->json());
    }

    private function parseResponse(array $response)
    {
        $this->scopes = explode(" ", $response['scope']);
        $this->access_token = $response['access_token'];
        $this->token_type   = $response['token_type'];
        $this->app_id = $response['app_id'];
        $this->expires_in = $response['expires_in'];
    }

    private function parseCredentials()
    {
        return base64_encode(config('billable.providers.paypal.token.CLIENT_ID').':'.config('billable.providers.paypal.token.CLIENT_SECRET'));
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    public function getAuthorizationHeader(): string
    {
        return $this->token_type." ".$this->access_token;
    }
}
