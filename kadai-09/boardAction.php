<?php
  
  //-------------------------------------------
  // 一覧作成
  //-------------------------------------------
  function make_list(){
    
    $v_sql = "SELECT name, comment, post_time ".
             "FROM simple_channel ".
             "ORDER BY post_time";
    //DB接続
    $v_mysql = db_connect();
    $v_result = $v_mysql->query($v_sql);
    //取得件数
    $v_count = $v_result->num_rows;
    //SQL切断
    $v_mysql->close();
    
    $v_output = "";
    
    //取得したデータが０件以上の場合
    if($v_count != 0){
      //一覧作成
      while($v_row = $v_result->fetch_assoc()){
        //名前
        $v_name = $v_row["name"];
        if($v_name == ""){
          $v_name = "名無しさん";
        }
        //日時形成
        $v_date = date('Y年n月j日', strtotime($v_row["post_time"]));
        $v_week = get_week($v_row["post_time"]);
        $v_time = date('H:i:s', strtotime($v_row["post_time"]));
        $v_post_date = $v_date . $v_week . $v_time;
        
        //HTMLタグ
        $v_output .= "<div class='one_post_area'>\n" .
                     "  <p>" . htmlspecialchars($v_name) . "　<span>" . $v_post_date . "</span></p>\n" .
                     "  <div>" . nl2br(htmlspecialchars($v_row["comment"])) . "</div>\n" .
                     "</div>\n\n";
      }
    }
    //取得したデータが０件の場合
    else{
      $v_output = "<p class='zero'>投稿数は０件です。</p>";
    }
    
    return $v_output;
  }
  
  //-------------------------------------------
  // 投稿を登録する
  //-------------------------------------------
  function insert_comment($p_post){
    //変数セット
    $v_name = $p_post["user_name"];
    $v_comment = $p_post["comment"];
    
    //DB接続
    $v_mysql = db_connect();
    $v_sql = "INSERT INTO simple_channel (name, comment, post_time) ".
             " VALUES (?, ?, CURRENT_TIMESTAMP)";
    
    if($v_stmt = $v_mysql->prepare($v_sql)){
      $v_stmt->bind_param("ss", $v_name, $v_comment);
      
      if(!$v_stmt->execute()){
        return false;
      }
    }
    else{
      return false;
    }
    
    //SQL切断
    $v_mysql->close();
    
    return true;
  }
  
  //-------------------------------------------
  // 日本語曜日取得
  //-------------------------------------------
  function get_week($p_date){
    //曜日
    $v_weekjp_array = array("日", "月", "火", "水", "木", "金", "土");
    //日付分割
    $v_date_array = explode("-", $p_date);
    
    //日付を指定
    $v_year  = $v_date_array[0];
    $v_month = ltrim($v_date_array[1], "0");
    $v_day   = ltrim($v_date_array[2], "0");
    
    //指定日のタイムスタンプを取得
    $v_timestamp = time(0, 0, 0, $v_month, $v_day, $v_year);
    //曜日の番号取得
    $v_weekno = date("w", $v_timestamp);
    
    return "（" . $v_weekjp_array[$v_weekno] . "）";
  }
  
  //-------------------------------------------
  // MySQLに接続する
  //-------------------------------------------
  function db_connect(){
    //DB情報
    $v_url  = "localhost";
    $v_user = "student_024";
    $v_pass = "mynet";
    $v_db   = "student_024";
    
    // MySQLへ接続する
    $v_mysql = new mysqli($v_url, $v_user, $v_pass, $v_db);
    
    if($v_mysql->connect_error){
      echo "<p class='error'>エラーです</p>";
      exit();
    }
    else{
      $v_mysql->set_charset("utf8");
    }
    
    return $v_mysql;
  }
  
?>