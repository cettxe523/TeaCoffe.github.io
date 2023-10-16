<?php
session_start();
include("common/func.php");
bd_connect();
error_reporting(0);
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Информация о заказе</title>
<link rel="stylesheet" type="text/css" href="style.css">
  <style>
   body {
    background: #c7b39b url(fon2.jpg); /* Цвет фона и путь к файлу */
    color: #000; /* Цвет текста */
   }
  </style>
</head>
 </html>
<?php
if (isset($_GET['oper']))
  {
      if ($_GET['oper']=='add') 
      {
        $sql="SELECT `hm` FROM `purchase` WHERE `id_client`='".$_SESSION['id_client']."' AND `artic`='".$_GET['artic']."' AND `id_order`=0";
		$q_ta = mysqli_query($db,$sql);
        if (mysqli_num_rows($q_ta)) 
          {
            $row_ta = mysqli_fetch_array($q_ta,MYSQLI_NUM);
			mysqli_query($db,"UPDATE `purchase` SET `hm`='".($row_ta[0]+1)."' WHERE `id_client`='".$_SESSION['id_client']."' AND `artic`='".$_GET['artic']."'  AND `id_order`=0");
          }
        else mysqli_query($db,"INSERT INTO `purchase` VALUES ('','".$_SESSION['id_client']."',0,'".$_GET['artic']."',1)");
		Header("Location:".$_SERVER['HTTP_REFERER']);
		echo'<h3>Товар добавлен в корзину! Вернитесь на предыдущую страницу. </h3>';
      }
     elseif ($_GET['oper']=='del') 
      {
        mysqli_query($db,"DELETE FROM `purchase` WHERE `id_client`='".$_SESSION['id_client']."' AND `artic`='".$_GET['artic']."'  AND `id_order`=0 LIMIT 1");
       Header("Location:".$_SERVER['HTTP_REFERER']);
	   echo'<h3>Товар удален из корзины! Вернитесь на предыдущую страницу. </h3>';
      }
  }
?>
