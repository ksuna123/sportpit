<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$email = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['email']))));
$login = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['login']))));
$password = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['password']))));
$passwordConfirm = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['password_confirm']))));

$check_login = $db->query("SELECT * FROM `user` WHERE `login` = '$login'");


$check_email = $db->query("SELECT * FROM `user` WHERE `email` = '$email'");

if ($check_email->num_rows > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Такой email уже используется",
        "fields" => ['email']
    ];

    echo json_encode($response);
    die();
}

if ($check_login->num_rows > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Такой логин уже существует",
        "fields" => ['loginReg']
    ];

    echo json_encode($response);
    die();
}

if (mb_strlen($login) < 3 || mb_strlen($login) > 15) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Недопустимая длина логина (от 3 до 15 символов)",
        "fields" => ['passwordReg']
    ];

    echo json_encode($response);
    die();
}

if (mb_strlen($password) < 3 || mb_strlen($password) > 20) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Недопустимая длина пароля (от 3 до 20 символов)",
        "fields" => ['loginReg']
    ];

    echo json_encode($response);
    die();
}


$error_fields = [];

if ($login === '') {
    $error_fields[] = 'loginReg';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}
if ($password === '') {
    $error_fields[] = 'passwordReg';
}
if ($passwordConfirm === '') {
    $error_fields[] = 'passwordReg-confirm';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}

if ($password === $passwordConfirm) {

    // $password = md5($password);
    $password = password_hash($password,PASSWORD_DEFAULT);
    
    $query = $db->query("INSERT INTO `user` (`id`, `login`, `email`, `password`,`admin`) VALUES (NULL,'$login','$email','$password','0')");

    // $_SESSION['message'] = 'Регистрация прошла успешно';
    // header('location:/public/profile.php');
    $queryU= $db->query("SELECT * FROM user WHERE user.login='$login' AND user.password= '$password'");
        $user=$queryU->fetch_assoc();
        $_SESSION['user']=[
            "id"=>$user['id'],
            "login"=>$user['login'],
            "email"=>$user['email'],
            "admin" => $user['admin']
        ];
  
    $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно"
    ];

    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "message" => "Пароли не совпадают",
    ];
    echo json_encode($response);
}
