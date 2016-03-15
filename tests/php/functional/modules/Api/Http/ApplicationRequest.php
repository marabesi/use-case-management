<?php

namespace Api\Http;

trait ApplicationRequest
{

    public function postApplication()
    {
        $request = $this->call('POST', 'api/application', [
            'name' => 'Test Application'
        ]);

        $response = $request->getContent();

        return json_decode($response);
    }
}