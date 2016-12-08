<?php

use MetzWeb\Instagram\Instagram;

class InstagramService
{
    private $instagram;
    private $loginUrl = null;


    public function __construct()
    {
        $this->instagram = new Instagram([
            'apiKey' => INSTAGRAM_API_KEY,
            'apiSecret' => INSTAGRAM_API_SECRET,
            'apiCallback' => INSTAGRAM_API_CALLBACK
        ]);
    }

    public function getLoginUrl()
    {
        if (is_null($this->loginUrl)) {
            $this->loginUrl = $this->instagram->getLoginUrl();
        }
        return $this->loginUrl;
    }

    public function retrieveAccessToken($code)
    {
        $modelUsers = ClassRegistry::init('Accesstokens');
        $tokenData = $this->instagram->getOAuthToken($code);

        $userExists = $modelUsers->find('first', ['conditions' => ['user_id' => $tokenData->user->id], 'fields' => 'user_id']);
        if (empty($userExists)) {
            $modelUsers->save(['user_id' => $tokenData->user->id, 'access_token' => $tokenData->access_token]);
        }
        $this->instagram->setAccessToken($tokenData);

    }

    public function getPosts($id = 'self', $limit = 10)
    {
        $modelPosts = ClassRegistry::init('Posts');

        $posts = $this->instagram->getUserMedia($id, $limit);
        if ($posts->meta->code == 200 && !empty($posts->data)) {
            foreach ($posts->data as $post) {
                $postExists = $modelPosts->findById($post->id);
                if(empty($postExists)){
                    $date = new DateTime();
                    $date->setTimestamp($post->created_time);

                    $modelPosts->save([
                        'id' =>$post->id,
                        'instagram_image_url'=>$post->images->standard_resolution->url,
                        'text'=> isset($post->caption->text) ? $post->caption->text : '',
                        'width'=>$post->images->standard_resolution->width,
                        'height'=>$post->images->standard_resolution->height,
                        'created' => $date->format("Y-m-d H:i:s")
                    ]);
                }
            }
        }

        return $posts;
    }

    public function setAccessToken($token)
    {
        $this->instagram->setAccessToken($token);
    }


}