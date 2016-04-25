<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>課題４</title>
<style>
  table{
    width: 900px;
    border-collapse: collapse;
  }
  th,td{
    border: solid 1px #777;
    padding: 6px;
  }
  th{
    text-align: left;
  }
  .req_bk{
    background: #FFD9D9;
    color: #ff0000;
  }
</style>
</head>
<body>
  リクエスト情報とサーバー変数の表示<br /><br />
  
  <table>
  <?php
    
    //表示するテーブル要素
    $v_table = "";
    
    //サーバー変数のテーブル作成
    foreach($_SERVER as $v_name => $v_value){
      
      //リクエストヘッダと同じ意味のものは色を変える
      if(substr($v_name, 0, 5) == "HTTP_"){
        $v_table .= "<tr class='req_bk'>\n";
      }
      else{
        $v_table .= "<tr>\n";
      }
      
      $v_table .= "  <th>$v_name</th>\n" . 
                  "  <td>" . htmlspecialchars($v_value) . "</td>\n" .
                  "</tr>\n" ;
    }
    
    echo $v_table;
  ?>
  </table>
  
  
</body>
</html>