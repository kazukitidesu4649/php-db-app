<?php
$dsn = 'mysql:dbname=znz5i0a0qels8ho0;host=cxmgkzhk95kfgbq4.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;charset=utf8mb4';
$user = 'jrsx40wb3ws0aj6l';
// MAMPを利用しているMacユーザーの方は、''ではなく'root'を代入してください
$password = 'f5sl6n9lhw443yfs';

try {
  $pdo = new PDO($dsn, $user, $password);

  // idカラムの値をプレースホルダ(:id)に置き換えたSQL文を予め用意する
  $sql_delete = 'DELETE FROM products WHERE id = :id';
  $stmt_delete = $pdo->prepare($sql_delete);

  //bindValue()メソッドを使って実際の値をプレースホルダにバインドする
  $stmt_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

  //SQL文を実行する
  $stmt_delete->execute();

  // 削除した件数を取得する
  $count = $stmt_delete->rowCount();

  $message = "商品を{$count}件削除しました。";

  // 商品一覧ページにリダイレクトさせる(同時にmessageパラメータも渡す)
  header("Location: read.php?message={$message}");
} catch (PDOException $e) {
  exit($e->getMessage());
}