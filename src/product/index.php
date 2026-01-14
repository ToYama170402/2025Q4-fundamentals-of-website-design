<?php
$products = [
  [1, "ショートケーキ", 400],
  [2, "チョコケーキ", 450],
  [3, "モンブラン", 500],
]; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>商品一覧</title>
  </head>
  <body>
    <h1>商品一覧</h1>
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
          <td><?= $product[0] ?></th>
          <td><?= $product[1] ?></td>
          <td><?= $product[2] ?></td>
          <td><a href="/product/detail.php?id=<?= $product[0] ?>">詳細</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </body>
</html>
