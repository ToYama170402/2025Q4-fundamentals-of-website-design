<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once './product/init.php';

if (empty($_POST['user_id'])) {
  header('Location: /login.html');
  exit;
}


$input_user_id = $_POST["user_id"];
$input_password = $_POST["password"];

$pdo = db();
$sql = "SELECT user_id,username,password,display_name
from fwd_users
where user_id = :user_id";

$statement = $pdo->prepare($sql);
$statement->bindParam(":user_id", $_POST["user_id"]);
$statement->execute();
$user = $statement->fetch();
if ($user && password_verify($input_password, $user['password'])) {
  session_start();
  session_regenerate_id(true);
  $_SESSION['user_id'] = (int)$user['user_id'];
  $_SESSION['username'] = (string)$user['username'];
  $_SESSION['display_name'] = (string)$user['display_name'] ?? "";
} else {
  header("Location: /login.html");
  exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン結果</title>
</head>

<body>
  <h1>ようこそ、<?= h($_SESSION['display_name'] ?: $_SESSION['username']) ?></h1>
  <a href="/product">商品一覧</a>
  <a href="/logout.php">ログアウト</a>
</body>

</html>