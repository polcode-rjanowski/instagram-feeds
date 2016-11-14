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

        $posts = $this->Posts->find('all');
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

    public function addLinkToImage()
    {
        if ($this->request->is('post')) {

            $post = $this->Posts->findById($this->request->data['image_id']);
            if (!empty($post)) {
                $this->Points->save([
                    'position' => $this->request->data['pos_x'] . "," . $this->request->data['pos_y'],
                    'position_percent' => 1,
                    'link' => $this->request->data['link']
                ]);

                $points = $post['Posts']['points'] == '' ? $this->Points->id : $post['Posts']['points'] . "," . $this->Points->id;
                $this->Posts->set('id', $this->request->data['image_id']);
                $this->Posts->set('points', $points);
                $this->Posts->save();

                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'error'];
            }

            echo json_encode($response);
            exit;
        }
    }

}