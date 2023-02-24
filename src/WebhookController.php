<?php

namespace Spatie\WebhookClient;

use Illuminate\Http\Request;

class WebhookController
{
    public function __invoke(Request $request, WebhookConfig $config)
    {
        (new WebhookProcessor($request, $config))->process();

        //initial request from Msgraph to validate webhook URL.
        $valid = $request->query('validationToken');
       
        if(!empty($valid)){
            
            return response($valid, 200)
            ->header('Content-Type', 'text/plain');

        }
        
        return response()->json(['message' => 'ok']);
    }
}
