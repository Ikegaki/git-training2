<?php
  require_once("boardAction.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>課題９</title>
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
  <div id="content">
    <p class="title">２ちゃんねるミニ</p>
    
    <?php
      $v_msg = "";
      
      if(isset($_POST['comment'])){
        if($_POST['comment'] == ""){
          $v_msg = "<p class='error'>内容を記入してください！</p>";
        }
        elseif(!insert_comment($_POST)){
          echo "<p class='error'>エラー発生</p>";
        }
      }
      
      //投稿内容表示
      echo make_list();
      
    ?>
    
    <form action="./board.php#comment" method="POST" class="fomr_area">
      <?php echo $v_msg; ?>
      <div class="input_area">
        <p>なまえ：<input type="text" name="user_name" value="<?php if(isset($_POST['user_name'])) echo $_POST['user_name']; ?>" /></p>
        <textarea name="comment" id="comment"></textarea><br />
        <input type="submit" value="送信！" />
      </div>
    </form>
    
  </div>
  
</body>
</html>