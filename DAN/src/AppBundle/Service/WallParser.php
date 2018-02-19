<?php


namespace AppBundle\Service;


class WallParser
{
    public function Parse($pageid) {

        $fb = new \Facebook\Facebook([
            'app_id' => '2100100350208898',
            'app_secret' => 'b07d3ad5d9b63a831e8c6cda9c459d96',
            'default_graph_version' => 'v2.10',
        ]);

        try {
            $response = $fb->get(
                '/'.$pageid.'/feed?limit=100',
                "2100100350208898|byz9XlAKxmhJQoHbI21zYtAs96g"
            );
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphEdge = $response->getGraphEdge();
        return self::ParseId($graphEdge);


    }

    public function ValidateId($id) {

        if (is_numeric($id)) {
            return true;
        }
        return false;
    }

    static function ParseId($graphEdge) {
        foreach ($graphEdge as $graphNode) {
            $array = $graphNode->asArray();
            $parts[] = explode("_", $array["id"]);
            $id[] = $parts[0][1];
        }
        return $id;
    }

}