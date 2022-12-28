<?php
include '../database/connection.php';

class QueriesToDataBase {
    private $classDbh;
    public function setConnection ($connection) {
        $this->classDbh = $connection;
    }
    public function getConnection () {
        return $this->classDbh;
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
    //Запрос на вывод "мои статьи"
    public function getMyPosts ($login) {
        $postsByUser = $this->classDbh->query("SELECT * FROM posts WHERE login = '$login'");
            return $postsByUser;
    }
    public function getOnePost ($id) {
        $one_posts = $this->classDbh->query("SELECT * FROM posts WHERE id = '$id'");
        foreach ($one_posts as $one_post) {
            return $one_post;
        }
    }
    //SEARCH
    public function searchPosts ($input){
        $search_query = ("SELECT * FROM posts WHERE title LIKE '{$input}%'");
        $statement = $this->classDbh->prepare($search_query);
        $statement->execute();
        return $statement->fetchAll();
    }

}
$queryToDataBase = new QueriesToDataBase();
$queryToDataBase->setConnection($dbh);
$queryToDataBase->getConnection();

class ChangeTheDataBaseByUsers {
    private $title;
    private $img;
    private $alt;
    private $text;
    private $id_category;
    private $login;

    private $queryToDataBaseClass;
    public function setQuery ($queryToDataBaseClass) {
        $this->queryToDataBaseClass = $queryToDataBaseClass;
    }
    public function getQuery () {
        return $this->queryToDataBaseClass;
    }
    public function setProperties($title, $img, $alt, $text, $id_category,  $login) {
        $this->title = $title;
        $this->img = $img;
        $this->alt = $alt;
        $this->text = $text;
        $this->id_category = $id_category;
        $this->login = $login;
    }
    public function getProperties() {
        return array($this->title, $this->img, $this->alt, $this->text, $this->id_category, $this->login);
    }
    public function addAPost () {
        $insertSql = ("INSERT INTO posts (title, img, alt, text, id_category, login) VALUES (:title, :img, :alt, :text, :id_category,  :login)");
        $statement = $this->queryToDataBaseClass->prepare($insertSql);
        $statement->execute([
            ':title' => $this->title,
            ':img' => $this->img,
            ':alt' => $this->alt,
            ':text' => $this->text,
            ':id_category' => $this->id_category,
            ':login' => $this->login,
        ]);
    }
    public function deletePost($id){
        $count = ("DELETE FROM posts WHERE id = '$id'");
        $this->queryToDataBaseClass->query($count);
    }
    public function changePost($id, $title, $img, $alt, $text, $id_category, $login ){
        $changed_post = ("UPDATE posts SET title='$title', text = '$text', img='$img', alt='$alt', id_category='$id_category', login='$login' WHERE id='$id'");
        $statement = $this->queryToDataBaseClass->prepare($changed_post);
        $statement->execute();
    }
}
$insert_post = new ChangeTheDataBaseByUsers();
$insert_post->setQuery($dbh);
$insert_post->getQuery();


//  Функция обрезки текста
function my_cut($string, $length) {
    $strlen = mb_strlen($string, 'UTF-8');

    if($strlen <= $length) {
        return $string;

    }
    $string2 = mb_substr($string, 0, $length, 'UTF-8'); // обрезаем и работаем со всеми кодировками и указываем исходную кодировку
    $position = mb_strrpos($string2, ' ', 'UTF-8'); // определение позиции последнего пробела в урезанной строке. Именно по нему и разделяем слова
    if($position === false) { // если нет пробелов
        $position = mb_strpos($string, ' ', 0, 'UTF-8'); // ищем позицию первого в исходной строке
    }
    $string = mb_substr($string, 0, $position, 'UTF-8'); // Обрезаем переменную по позиции
    return $string . ' . . .';
}

// Star rating

class StarRating {
    private $queryToDataBaseClass;

    public function setQuery ($queryToDataBaseClass) {
        $this->queryToDataBaseClass = $queryToDataBaseClass;
    }

    public function getQuery () {
        return $this->queryToDataBaseClass;
    }

    public function setValue($id_post, $value, $login) {
        $insertStar = ("INSERT INTO stars (id_post, value, user) VALUES (:id_post, :value, :user)");
        $statement = $this->queryToDataBaseClass->prepare($insertStar);
        $statement->execute([
            ':id_post' => $id_post,
            ':value' => $value,
            ':user' => $login
        ]);
    }

    public function checkStar ($id_post, $login) {
        $star_checked = $this->queryToDataBaseClass->query("SELECT * FROM stars WHERE id_post = '$id_post' AND user = '$login'");
        return $star_checked;
    }

    public function changeValue($id_post, $login, $value) {
        $stars_query = ("UPDATE stars SET value='$value' WHERE id_post = '$id_post' AND user = '$login'");
        $statement = $this->queryToDataBaseClass->prepare($stars_query);
        $statement->execute();
        //return $statement->fetchAll();
    }

    public function getStars($id_post) {
        $stars_query = ("SELECT * FROM stars WHERE id_post = '$id_post'");
        $statement = $this->queryToDataBaseClass->prepare($stars_query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getRating($id_post) {
        $arrayOfStars = array();
        $arrayOfValues = array();
        $arrayOfStars = $this->getStars($id_post);
//        return $arrayOfStars;
        $count = count($arrayOfStars);
        foreach ($arrayOfStars as $value) {
            array_push($arrayOfValues, $value['value']);
        }
        $sum = array_sum($arrayOfValues);
        $result = $sum / $count;
        $result = round($result,2);
        return $result;
    }

}
$star = new StarRating();
$star->setQuery($dbh);
$star->getQuery();



?>


