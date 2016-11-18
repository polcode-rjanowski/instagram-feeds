<?php
App::uses('InstagramService', 'services');

class AdminController extends AppController
{
    public $uses = ['Posts', 'Points'];
    public $components = ['Auth', 'Session'];

    public function beforeFilter()
    {
        $this->Auth->deny();
        $this->Auth->loginAction = ['controller' => 'admin', 'action' => 'login'];
        $this->Auth->logoutRedirect = ['controller' => 'admin', 'action' => 'login'];
        $this->Auth->loginRedirect = ['controller' => 'admin', 'action' => 'posts'];
    }

    public function login()
    {
        $this->Auth->allow();
        if ($this->Auth->loggedIn()) {
            $this->redirect(['controller' => 'admin', 'action' => 'posts']);
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login($this->request->data)) {
                $this->Session->write('Auth.loggedIn', true);
                $this->redirect(['controller' => 'admin', 'action' => 'posts']);
            } else {
                $this->Session->setFlash('Incorrect login or password');
            }
        }
    }

    public function logout()
    {
        $this->Auth->allow();
        $this->Session->delete('Auth.loggedIn');
        if ($this->Auth->loggedIn()) {
            $this->redirect($this->Auth->logout());
        } else {
            $this->redirect(['action' => 'login']);
        }
    }

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

            $data = $this->request->data;
            $post = $this->Posts->findById($data['image_id']);
            if (!empty($post)) {
                if ($data['dot_id'] != 0) {
                    $this->Points->set('id', $data['dot_id']);
                    $this->Points->set('link', $data['link']);
                    $this->Points->save();
                } else {
                    $widthPercent = round(($data['pos_x'] / $data['img_width']), 2) * 100;
                    $heightPercent = round(($data['pos_y'] / $data['img_height']), 2) * 100;

                    $this->Points->save([
                        'position' => $data['pos_x'] . "," . $data['pos_y'],
                        'position_percent' => $widthPercent . "," . $heightPercent,
                        'link' => $data['link']
                    ]);

                    $points = $post['Posts']['points'] == '' ? $this->Points->id : $post['Posts']['points'] . "," . $this->Points->id;
                    $this->Posts->set('id', $data['image_id']);
                    $this->Posts->set('points', $points);
                    $this->Posts->save();
                }

                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'error'];
            }

            echo json_encode($response);
            exit;
        }
    }

    public function removeDot()
    {
        if ($this->request->is('post') && isset($this->request->data['dot_id']) && $this->request->data['dot_id']) {
            $this->Points->delete($this->request->data['dot_id']);
            $response = ['status' => 'success'];
            echo json_encode($response);
            exit;
        }
    }
}