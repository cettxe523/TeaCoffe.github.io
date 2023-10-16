<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Магазин чая и кофе</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="img/icon.ico" rel="shortcut icon" type="image/x-icon"/>
</head>

<body>
<table width="100%" height="100%" border="1" cellpadding="5" cellspacing="3">
  <tr>
     <td width="280"><div style="margin-left:30px;"><form method="get" action="http://coffe-tea-shop.ru/">
      Поиск: 
      <input name="search" type="text" size="20" maxlength="64" value="<?php if (isset($_GET['search'])) echo $_GET['search'];?>" />
	  <input type="submit" value="Найти!"/></form></div></td>
	 
  <td class="style7" width="280" align="center" bgcolor=#FFDEAD><a href="http://coffe-tea-shop.ru/" title="На главную">
        <img src="img/logo2.jpg" title="Интернет-магазин" alt="Интернет-магазин" align="left" width=120>
	        </a><span>Магазин чая и кофе <br></span></td>
 </tr>
  <tr class="style2">
    <td valign="top">
     <strong>Навигация</strong>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr align="center">
          <td class="style5">- <a href="http://coffe-tea-shop.ru/">Главная</a></td>
        </tr>
          <tr align="center">
          <td class="style5">- <a href="http://coffe-tea-shop.ru/about.php">О магазине</a></td>
        </tr>
		<tr>
    <td><marquee behavior="scroll" direction="right"> <img src="img/2.png" /> </marquee></td>
        </tr>
        <tr class="style2" align="center">
          <strong class="style2"><td>Каталог:<br></strong>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <?php
			$sql="SELECT * FROM `tovar_types` WHERE 1";
			$q_types = mysqli_query($db,$sql);
			while ($row_types = mysqli_fetch_array($q_types,MYSQLI_NUM))
							              {
                  echo '
              <tr>
                <td align="center"><font size=5><p><span class="style4"><a href="http://coffe-tea-shop.ru/?vid=catalog&type='.$row_types[0].'">'.$row_types[1].'</a></span></p></font size=5></td>
              </tr>';
                } 
			?>
            </table></td>
        </tr>
        <tr>
          <td><br>
		  <hr color=navy size=10>
     <?php
      if (isset ($_SESSION['name_client'])) echo "<br><br>Приветствую, ".$_SESSION['name_client']."! <br><br><br> <a href='http://coffe-tea-shop.ru/reg.php?exit=1'>Выход</a>";
      else 
        echo '
		  <form method="get" action="http://coffe-tea-shop.ru/reg.php">
            <br><br> <strong>Гость. Авторизация: </strong>
		    <br><br> <strong>e-mail:  <input name="mail" type="text" size="30" maxlength="50" /> </strong>
			<br><br> <strong>пароль:  <input name="pas" type="password" size="20" maxlength="20" /><input name="enter" type="submit" value="Войти" /> </strong>
			<br><br><a href="http://coffe-tea-shop.ru/reg.php">Регистрация</a>
		    </form>';		  
      ?>
       </td>
       </tr>
       <tr>
       <td> </td>
       </tr>
      </table>
     </td>
    <td valign="top">