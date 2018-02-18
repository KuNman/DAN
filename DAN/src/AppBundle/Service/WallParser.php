<?php


namespace AppBundle\Service;

class WallParser
{
    public function Parse($id) {
        $fb = new \Facebook\Facebook([
            'app_id' => '2100100350208898',
            'app_secret' => 'b07d3ad5d9b63a831e8c6cda9c459d96',
            'default_graph_version' => 'v2.10',
            'default_access_token' => 'EAAd2B7dd64IBAKRGeBW7xwVjDpQTjCwgqP9rIpj1WvnbOQeBuW1O0TyD0w2bR2dZBUiqSiYjhZCxwL0LWrwFnPBvzON0k94ZBSpMk7ZBR1uF0P7OQzJ2sf4ahou3HrSMK5sbOCbHcvV2aHgdTflRO0IRZBRrmZAM59kmyWYZAg2WllNr1aBNJfObKBB7X5a2nhqhfkhtRDcIGYnwvZAHqgiqpNwOA455hZCxTSaNXekL3NgZDZD'
        ]);

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        echo 'Logged in as ' . $me->getName();
    }

}