<?php
session_start();
include("common/func.php");
bd_connect();
error_reporting(0);
?>
<?
include("common/top.php");
if (isset($_GET['enter'])) 
  {
	$sql ="SELECT `id_client`,`name` FROM `clients` WHERE `mail`='".$_GET['mail']."' AND `pas`='".$_GET['pas']."' limit 1";   
    $q_guest = mysqli_query($db,$sql);
    if (mysqli_num_rows($q_guest)==1) 
      {
        $row_q_guest = mysqli_fetch_array($q_guest,MYSQLI_NUM);
        $_SESSION['id_client'] = $row_q_guest[0];
        $_SESSION['name_client'] = $row_q_guest[1];
      }
Header("Location:http://coffe-tea-shop.ru/");
	}
elseif (isset($_POST['reg']) AND $_POST['name']!='' AND $_POST['mail']!='' AND $_POST['pas']!='' AND $_POST['address']!='' AND $_POST['phone']!='')
  {
    
	mysqli_query($db,"INSERT INTO `clients` VALUES ('', '".$_POST['name']."', '".$_POST['mail']."', '".$_POST['pas']."', '".$_POST['address']."', '".$_POST['phone']."', '".$_POST['comments']."')");
    Header("Location:http://coffe-tea-shop.ru/reg.php?enter=1&mail=".$_POST['mail']."&pas=".$_POST['pas']);
	
  }
elseif (isset($_GET['exit']))
  {
    unset ($_SESSION['id_client']);
    unset ($_SESSION['name_client']);
    Header("Location:http://coffe-tea-shop.ru/");
  } 
?>
			
  
     <form method="post" action="">
	     <br />
	   <strong>Регистрация      </strong><br>
	     <hr>
		   <br />
		     Фамилия И.О.*<BR>
	     <INPUT style="WIDTH: 200px" NAME="name" type="text" value="">
	     <br />
	     Контактный e-mail*<BR>
	     <INPUT style="WIDTH: 200px" NAME="mail" type="text" value="">
         <br />Пароль для входа на сайт*<br />
	     <input name="pas" type="password" size="20" maxlength="20" />
         <br />
	     Адрес доставки* <br>
	     <input style="WIDTH: 500px" NAME="address" value="">
	     <br />
	     Контактный телефон*<BR>
	     <INPUT style="WIDTH: 200px" NAME="phone" type="text">
	     <br />
	     Комментарии<br>
	     <textarea style="WIDTH: 500px; height:70px" NAME="comments"></textarea>
	     <br />
	     <i class="style4">Поля отмеченные символом * обязательны для заполнения</i>
	     <br />
		<input name="reg" type="submit" value="Регистрация" />
          </p>
     </form><br />
<?php include("common/bottom.php");?>