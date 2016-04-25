<?php 
  //初回正答をセット
  if (!isset($_COOKIE['question'])){
    make_cookie();
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>課題８</title>
<style type="text/css">
</style>
</head>
<body>
  ヒット＆ブロー<br /><br />
  
  <form action="" method="POST">
    数字４桁を入力しよう！<br />
    <input type="text" name="input_ans" maxlength=4 size=4 value="<?php if(isset($_POST['input_ans'])) echo $_POST['input_ans']; ?>" />
    <input type="submit" value="判定は？" />
    
    <?php
      
      //初期値
      $v_hit = 0;   //Hit数
      $v_blow = 0;  //Blow数
      $v_count = 0; //回数
      
      if(isset($_POST["input_ans"])){
        $v_ans = $_POST["input_ans"];
        $v_qes = $_COOKIE["question"];
        
        //配列にする
        $v_num_array = str_split($v_qes);
        $v_ans_array = str_split($v_ans);
        
        //添字の確認を含めて配列の共通項を求める
        $v_result1 = array_intersect_assoc($v_num_array, $v_ans_array);
        //配列の共通項を求める
        $v_result2 = array_intersect($v_num_array, $v_ans_array);
        
        $v_hit = count($v_result1);
        $v_blow = count($v_result2) - $v_hit;
        $v_count = (!isset($_POST['decision_count'])) ? 0 : $_POST['decision_count'] + 1;
        
      }
      
      echo "<p>" . $v_hit . "Hit　" . $v_blow . "Blow　" . $v_count . "回目</p>";
      
      //みごと正解したら初期化＆メッセージ表示
      if($v_hit == 4){
        //カウント初期化
        $v_count = 0;
        unset($_POST['decision_count']);
        
        echo "<p style='font-size:20pt;color:red;font-weight:bold;'>「" . $v_qes . "」です！大正解！！</p>";
        //新しい正答セット
        make_cookie();
      }
      
      //-------------------------------------------
      // ランダム数字を生成してCookieにセットする
      //-------------------------------------------
      function make_cookie(){
        //ランダム数字４桁
        $v_number = "";
        $v_random = range(0, 9);
        shuffle($v_random);
        
        for($i=0; $i<4; $i++){
          $v_number .= $v_random[$i];
        }
        setcookie("question", $v_number);
      }
      
    ?>
  
    <input type="hidden" name="decision_count" value="<?php echo $v_count; ?>" />
  </form>
</body>
</html>