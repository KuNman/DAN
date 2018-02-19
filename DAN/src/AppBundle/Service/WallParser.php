<?php


namespace AppBundle\Service;


class WallParser
{
    public function Parse($pageid) {

        $pageid= self::getPosts($pageid);
        foreach ($pageid as $value) {
            $reactions[] = self::getLikes($value);
        }

        return array("pageid" => $pageid, "reactions" => $reactions);
    }

    public function ValidateId($id) {

        if (is_numeric($id)) {
            return true;
        }
        return false;
    }

    static function getPosts($pageid) {
        $fb = new \Facebook\Facebook([
            'app_id' => '2100100350208898',
            'app_secret' => 'b07d3ad5d9b63a831e8c6cda9c459d96',
            'default_graph_version' => 'v2.10',
        ]);
        try {
            $response = $fb->get(
                '/'.$pageid.'/feed?limit=2',
                "2100100350208898|byz9XlAKxmhJQoHbI21zYtAs96g"
            );
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphEdgePosts = $response->getGraphEdge();
        return self::ParseId($graphEdgePosts);
    }


    static function getLikes($value) {

        $fb = new \Facebook\Facebook([
            'app_id' => '2100100350208898',
            'app_secret' => 'b07d3ad5d9b63a831e8c6cda9c459d96',
            'default_graph_version' => 'v2.10',
        ]);

        try {
            $response = $fb->get(
                '/'.$value.'/likes?summary=true',
                '2100100350208898|byz9XlAKxmhJQoHbI21zYtAs96g'
            );
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphEdgeReactions = $response->getDecodedBody();
        return self::ParseLikes($graphEdgeReactions);
    }

    static function ParseId($graphEdgePosts) {

        foreach ($graphEdgePosts as $graphNode) {
            $array = $graphNode->asArray();
            $postsId[] = $array["id"];
        }
        return $postsId;
    }

    static function ParseLikes($graphEdgeReactions) {

        return $reactionsAmount[] = $graphEdgeReactions["summary"]["total_count"];
    }

}