<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$to = "ksenia.konuk@mail.ru";
$name = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['name']))));
$tel = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['tel']))));
$text = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['message']))));
$subject = "Новое сообщение";
$message="Имя: ".$name."<br>";
$message.="Телефон: ".$tel."<br>";
$message.="Сообщение: ".$text."<br>";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html;";
$headers .= "From: $name";

if (!empty($text)) {
    if (!empty($tel) && preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $tel)) {
        if (!empty($name)) {
            $result = mail($to, $subject, $message, $headers);
        } else {
            echo 2;
        }
    } else {
        echo 3;
    }
} else {
    echo 1;
}
