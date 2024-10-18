<?php
  $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
  $user = 'root';
  $password = 'root';

  try {
    $pdo = new PDO($dsn, $user, $password);
    
    //orderパラメータの値が存在すれば（並べ替えボタンを押したとき）、変数$orderに代入する
    if (isset($_GET['order'])) {
      $order = $_GET['order'];
    } else {
      $order = 'NULL';
    }

    // orderパラメータの値によってSQL文を変更する
    if ($order == 'desc') {
      $sql_select = 'SELECT * FROM products ORDER BY update_at DESC';
    } else {
      $sql_select = 'SELECT * FROM products ORDER BY update_at ASC';
    }

    // SQL文を実行する
    $stmt_select = $pdo->query($sql_select);

    // SQL文の実行結果を配列で取得する
    $products = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>商品一覧</title>
      <link rel="stylesheet" href="css/style.css">

      <!-- Google Fonts の読み込み -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="preconnect" >
</head>

<body>
    <header>
        <nav>
            <a href="index.php">商品管理アプリ</a>
        </nav>
    </header>
    <main>
          <article class="products">
                <h1>商品一覧</h1>
                <div class="products-ui">
                    <div>
                        <!-- 並び替えボタン　検索ボックス -->
                         <a href="read.php?order=desc">
                            <img src="images/desc.png" alt="降順に並び替え" class="sort-img">
                         </a>
                         <a href="read.php?order=asc">
                            <img src="images/asc.png" alt="昇順に並び替え" class="sort-img">
                         </a>
                    </div>
                    <a href="#" class="btn">商品登録</a>
                </div>
                <table class="products-table">
                    <tr>
                        <th>商品コード</th>
                        <th>商品名</th>
                        <th>単価</th>
                        <th>在庫数</th>
                        <th>仕入先コード</th>
                    </tr>
                    <?php
                    // 配列の出力 foreach
                    foreach ($products as $product) {
                      $table_row = "
                            <tr>
                            <td>{$product['product_code']}</td>
                            <td>{$product['product_name']}</td>
                            <td>{$product['price']}</td>
                            <td>{$product['stock_quantity']}</td>
                            <td>{$product['vender_code']}</td>
                            </tr>
                      ";
                      echo $table_row;
                    }
                    ?>
                </table>
          </article>
    </main>

    <footer>
        <p class="copyright">&copy; 商品管理アプリ All rights reserved.</p>
    </footer>
</body>

