<?php
function db(): PDO
{
  $mysql_user = getEnv("MYSQL_USER");
  $mysql_password = getEnv("MYSQL_PASSWORD");
  $dsn = "mysql:host=db;dbname=mydb;charset=utf8mb4";
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  try {
    return new PDO($dsn, $mysql_user, $mysql_password, $options);
  } catch (PDOException $e) {
    exit("DB接続に失敗しました：" . $e->getMessage());
  }
}

function h(string $str): string
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
