<?php

use Phalcon\Mvc\Controller;

class ApiuserController extends Controller
{
    public function indexAction()
    {

    }
    public function signupAction()
    {
        $postdata = $this->request->getPOst();
        if (count($postdata) > 0 ) {
            print_r($postdata);
            // die;
            $user = new Apiusers;
            $user->insert($postdata);
        }

    }
    public function loginAction()
    {

    }
}
