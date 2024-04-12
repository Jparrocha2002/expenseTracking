<?php
include_once "../model/User.php";

class userController extends User
{
    public function registerHandler()
    {
       return $this->register($_POST);
    }

    public function loginHandler()
    {
       return $this->login($_POST);
    }

    public function allData()
    {
      return $this->getAll();
    }
}
?>