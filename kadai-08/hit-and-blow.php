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
  </form>
  <?php
    
    //初期値
    $v_hit = 0;   //Hit数
    $v_blow = 0;  //Blow数
    $v_count = 0; //回数
    $v_msg = "";  //エラーメッセージ初期値
    
    if(isset($_COOKIE["data"])){
      $v_data = $_COOKIE["data"];
    }
    //cookieに正答がない場合
    else{
      $v_data = make_start_data();
    }
    
    //データを分割して配列に
    $v_data_array = explode("/", $v_data);
    $v_qes = $v_data_array[0];        //正答
    $v_cookie_cnt = $v_data_array[1]; //保持されている回数
    
    $v_count = $v_cookie_cnt;
    
    //入力された値と比較
    if(isset($_POST["input_ans"])){
      $v_ans = $_POST["input_ans"];
      
      //配列にする
      $v_num_array = str_split($v_qes);
      $v_ans_array = str_split($v_ans);
      
      //値が４桁以下または値が空の場合
      if(count($v_ans_array) < 4 || $v_ans == ""){
        $v_msg = "<p style='color:red'>４桁の数字を入力してください</p>";
      }
      //数字が重複している場合
      elseif(!check_overlap($v_ans_array)){
        $v_msg = "<p style='color:red'>重複しない４桁の数字を入力してください</p>";
      }
      //入力された値に問題がない場合
      else{
        $v_count++;
        
        //添字の確認を含めて配列の共通項を求める
        $v_result1 = array_intersect_assoc($v_num_array, $v_ans_array);
        //配列の共通項を求める
        $v_result2 = array_intersect($v_num_array, $v_ans_array);
        
        $v_hit = count($v_result1);
        $v_blow = count($v_result2) - $v_hit;
      }
    }
    
    //勝敗表示（値が正しく入力されていない場合は、HIT等があっても結果は0と表示する）
    echo "<p>" . $v_hit . "Hit　" . $v_blow . "Blow　" . $v_count . "回目</p>";
    
    //エラー文言表示
    echo $v_msg;
    
    //みごと正解したら初期化＆メッセージ表示
    if($v_hit == 4){
      echo "<p style='font-size:20pt;color:red;font-weight:bold;'>「" . $v_qes . "」です！大正解！！</p>";
      //cookieを削除
      setcookie('data', '', time() - 1);
    }
    else{
      //回数をcookieにセット
      $v_update = $v_qes . "/" . $v_count;
      setcookie("data", $v_update);
    }
    
    //-------------------------------------------
    // 値を生成する
    //-------------------------------------------
    function make_start_data(){
      //ランダム数字４桁
      $v_number = "";
      $v_random = range(0, 9);
      shuffle($v_random);
      
      for($i=0; $i<4; $i++){
        $v_number .= $v_random[$i];
      }
      
      //問題と回数を１文字列にする
      $v_start = $v_number . "/0";
      
      return $v_start;
    }
    
    //-------------------------------------------
    // 入力値重複チェック
    //-------------------------------------------
    function check_overlap($p_array){
      //配列の値の出現回数をカウント
      $v_check_arr = array_count_values($p_array);
      
      foreach($v_check_arr as $v_value){
        //出現回数が２回以上があった場合重複
        if($v_value > 1){
          return false;
        }
      }
      return true;
    }
    
  ?>
  
</body>
</html>