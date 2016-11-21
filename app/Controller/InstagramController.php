<?php
App::uses('InstagramService', 'services');

class InstagramController extends AppController
{
    public $uses = ['Posts', 'Points'];

    public function posts()
    {
        $instagramService = new InstagramService();

        $this->set('loginUrl', $instagramService->getLoginUrl());

        if (isset($_GET['code'])) {
            $instagramService->retrieveAccessToken($_GET['code']);
            $media = $instagramService->getPosts();
        }

        $posts = $this->Posts->find('all', ['order'=>'created DESC']);
        foreach ($posts as $key => $post) {
            if ($post['Posts']['points'] != '') {
                $pointsIds = explode(',', $post['Posts']['points']);
                if (!empty($pointsIds)) {
                    $points = $this->Points->find('all', ['conditions' => ['id' => $pointsIds]]);
                    $posts[$key]['Points'] = $points;
                }
            }
        }
        
        $this->set('posts', $posts);
    }
}