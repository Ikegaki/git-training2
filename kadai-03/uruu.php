<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>課題３</title>
</head>
<body>
  うるう年判定<br /><br />
  西暦を入力してください。<br />
  <form action="" method="POST">
    <input type="text" name="year" size="5" value="<?php if(isset($_POST['year'])) echo $_POST['year']; ?>" /> 年 
    
    <input type="submit" value="判定！" />
  </form>
  
  <?php
    //初期値でメッセージがでないように
    if(isset($_POST["year"])){
    
      //テキストに入力された値
      $v_year = $_POST["year"];
      
      //入力された値をチェック
      if(!is_numeric($v_year)){
        echo "<p style='color:red;'>エラーです。正しい西暦を入力してください！</p>";
      }
      //うるう年条件↓↓↓
      //・西暦が4で割り切れる年はうるう年である。
      //・100で割り切れる年は平年である。
      //・400で割り切れる年はうるう年である。
      //elseif(date('L', mktime(0, 0, 0, 1, 1, $v_year))){ ←関数を使った場合
      elseif(($v_year % 4 == 0 && $v_year % 100 != 0) || $v_year % 400 == 0){
        echo $v_year . "年はうるう年です！";
      }
      else{
        echo $v_year . "年はうるう年ではありません！";
      }
    }
    
  ?>
</body>
</html>