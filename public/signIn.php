<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$login = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['login']))));
$password = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['password']))));

$error_fields = [];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'passwordSignIn';
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

// $password = md5($password);

$check_user = $db->query("SELECT * FROM user WHERE user.login='$login' ");
if ($check_user->num_rows > 0) {
    $user = $check_user->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "email" => $user['email'],
            "admin" => $user['admin']
        ];

        $response = [
            "status" => true
        ];


        // header('location:/public/profile.php');
        echo json_encode($response);
    }
} else {

    $response = [
        "status" => false,
        "message" => 'Не верный логин или пароль'
    ];
    echo json_encode($response);
    // $_SESSION['message'] = 'Не верный логин или пароль';
    // header('location:/private/header.php');

}
