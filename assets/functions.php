<?php
include '../database/connection.php';

class QueriesToDataBase {
    private $classDbh;
    public function __construct ($dbh){
        $this->classDbh = $dbh;
    }
    public function getAllPosts () {
        $posts = $this->classDbh->query("SELECT * FROM `posts`");
        return $posts;
    }
    public function getAllCategories () {
        $categories = $this->classDbh->query("SELECT * FROM `categories`");
        return $categories;
    }
    public function getCategoriesById ($id) {
        $categories = $this->classDbh->query("SELECT * FROM `categories` WHERE `id` = " . $id);
        foreach ($categories as $category) {
            return $category;
        }
    }
    //Запрос на проверку пользователя в базе данных
    public function checkUserIsset ($login) {
        $users_checked = $this->classDbh->query("SELECT login FROM users WHERE login = '$login'");
        return $users_checked;
    }
    //Запрос на проверку почты в базе данных
    public function checkEmailIsset ($email) {
        $email_checked = $this->classDbh->query("SELECT login FROM users WHERE email = '$email'");
        return $email_checked;
    }

}

$queryToDataBase = new QueriesToDataBase ($dbh);


