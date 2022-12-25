<?php
session_start();
include '../path.php';
include '../assets/functions.php';
include 'head.php';
header("Content-Disposition: attachment");
require_once '../vendor/autoload.php';
$title = $_SESSION['title_pdf'];
$name = $title;
$img = $_SESSION['img_pdf'];
$url = BASE_URL.'/'.$img;
$text = $_SESSION['text_pdf'];
$text = "<p>". str_replace("\n", "</p>\n<p>", $text)."</p>";
var_dump($_SESSION['img_pdf']);
if(!empty($_SESSION['img_pdf'])) {
    $html = '
            <span>Скачано с bobra</span><hr>
            <h2>'.$title.'</h2><br>
            <img src="../'.$img.'" style="max-width: 200px; max-height: 200px; float: left; margin: 0 1em 0em 0;"/><br/>
            <div style="text-align: justify; width: 100%; padding-top: -35px">'.$text.'</div>
        ';
} else {
    $html = '
            <span>Скачано с bobra</span><hr>
            <h2>'.$title.'</h2><br>
            <div style="text-align: justify; width: 100%; padding-top: -35px">'.$text.'</div>
        ';
}



$mpdf = new \mPDF();
$mpdf->WriteHTML("{$html}");
ob_clean();
$mpdf->Output($name.'.pdf', 'D');
?>

