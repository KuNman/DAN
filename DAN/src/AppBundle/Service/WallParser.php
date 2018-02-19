<?php


namespace AppBundle\Service;


class WallParser
{
    public function Parse($id) {

        $fb = new \Facebook\Facebook([
            'app_id' => '2100100350208898',
            'app_secret' => 'b07d3ad5d9b63a831e8c6cda9c459d96',
            'default_graph_version' => 'v2.10',
        ]);

        try {
            $response = $fb->get(
                '/'.$id.'/posts',
                "2100100350208898|byz9XlAKxmhJQoHbI21zYtAs96g"
            );
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $graphEdge = $response->getGraphEdge();
    }

    public function ValidateId($id) {

        if (is_numeric($id)) {
            return true;
        }
        return false;
    }

}