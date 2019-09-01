<?php

namespace App\Controller;

use AlterPHP\EasyAdminExtensionBundle\Controller\EasyAdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    public function updateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function inicio()
    {
        return $this->render('admin/index.html.twig');
    }
}
