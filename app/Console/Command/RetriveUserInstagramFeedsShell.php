<?php
App::uses('InstagramService', 'services');
class RetriveUserInstagramFeedsShell extends AppShell
{
    public $uses = ['Users', 'Posts'];

    public function main(){

        $instagram = new InstagramService();

        $users = $this->Users->find('all');
        if(!empty($users)){
            foreach ($users as $user){
                $instagram->setAccessToken($user['Users']['access_token']);
                $instagram->getPosts();
            }
        }

    }
}