<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: /login.php');
  exit;
}

require_once 'init.php';
$pdo = db();
$sql = "SELECT id, name, price
FROM fwd_products
WHERE id=:id;";
$statement = $pdo->prepare($sql);

$current_product_id = isset($_GET["id"]);
$statement->bindParam(":id", $current_product_id, PDO::PARAM_INT);
$statement->execute();
$products = $statement->fetchAll();
$current_product = $products[0]

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>商品詳細</title>
</head>

<body>
  <?php if ($current_product === null): ?>
    <h1>商品が見つからなかったよ</h1>
    <p>ごめんね</p>
    <p>にゃーん</p>
  <?php else: ?>
    <h1><?= h($current_product["name"]) ?></h1>
    <p>¥<?= h($current_product["price"]) ?></p>
  <?php endif; ?>
</body>

</html>