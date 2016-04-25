<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>課題２</title>
<body>
  1から10までの数を全て足した結果を画面に表示する。<br /><br />
  <?php
    
    //計算結果を格納
    $v_sum = 0;
    
    //1～10足し算ループ
    for($i=1; $i<=10; $i++){
      $v_sum += $i;
    }
    
    //解答出力
    echo "足し算の結果は" . $v_sum . "です。";
    
  ?>
</body>
</html>