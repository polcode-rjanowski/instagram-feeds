<?php
App::uses('InstagramService', 'services');
class RetriveUserInstagramFeedsShell extends AppShell
{
    public $uses = ['Accesstokens', 'Posts'];

    public function main(){

        $instagram = new InstagramService();

        $users = $this->Accesstokens->find('all');
        if(!empty($users)){
            foreach ($users as $user){
                $instagram->setAccessToken($user['Accesstokens']['access_token']);
                $instagram->getPosts();
            }
        }

    }
}