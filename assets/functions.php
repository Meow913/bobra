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
}

$queryToDataBase = new QueriesToDataBase ($dbh);


