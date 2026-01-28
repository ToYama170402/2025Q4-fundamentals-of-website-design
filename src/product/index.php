<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'init.php';

session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: /login.html');
  exit;
}

$pdo = db();
$sql = "SELECT fd.id, fd.name, fd.price, fc.category_name
  FROM fwd_products fd, fwd_categories fc
  WHERE fd.category_id = fc.category_id
    and is_active = :is_active
    and fd.category_id is not null
  ORDER BY fc.category_id, fd.id";

$is_active = TRUE;
$statement = $pdo->prepare($sql);
$statement->bindParam(':is_active', $is_active, PDO::PARAM_INT);
$statement->execute();
$products = $statement->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>商品一覧</title>
</head>

<body>
  <h1>商品一覧(ログイン中)</h1>
  <p>ようこそ、<?= h($_SESSION['display_name'] ?: $_SESSION['username']) ?>さん</p>
  <p><a href="/logout.php">ログアウト</a></p>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>商品名</th>
        <th>価格</th>
        <th>詳細</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product): ?>
        <tr>
          <td><?= h($product["id"]) ?></th>
          <td><?= h($product["name"]) ?></td>
          <td><?= h($product["price"]) ?></td>
          <td><a href="/product/detail.php?id=<?= $product["id"] ?>">詳細</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>