<?php
$products = [
  [1, "ショートケーキ", 400],
  [2, "チョコケーキ", 450],
  [3, "モンブラン", 500],
]; ?>
<?php $currentProduct = isset($_GET["id"])
  ? array_find($products, fn($product) => $product[0] == $_GET["id"])
  : null; ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <title>商品詳細</title>
  </head>
  <body>
    <?php if ($currentProduct === null): ?>
    <h1>商品が見つからなかったよ</h1>
    <p>ごめんね</p>
    <p>にゃーん</p>
    <?php else: ?>
    <h1><?= $currentProduct[1] ?></h1>
    <p>¥<?= $currentProduct[2] ?></p>
    <?php endif; ?>
  </body>
</html>
