<?php 
session_start();
include("common/func.php");
bd_connect();
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Магазин чая и кофе. Главная</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="img/icon.ico" rel="shortcut icon" type="image/x-icon"/>
</head>
<body style="body">
<?
include("common/top.php");
if (isset($_GET['search'])) 
  {
    $vid='search'; 
    $zag='Результаты поиска:'; 
    $word= explode(" ",$_GET['search']);
    $good_q = "";
    for ($i=0;$i<count($word);$i++)
      {
        $stemmer = new Lingua_Stem_Ru();
        $good_q.= $stemmer->stem_word($word[$i])."*";
      }
    $sql = "SELECT * FROM `tovar`,`tovar_types` WHERE `tovar_types`.`id_tovar_type`=`tovar`.`id_tovar_type` 
	AND MATCH `tovar`.`name` AGAINST ('".$good_q."' IN BOOLEAN MODE)"; 
  }
elseif (isset($_GET['vid'])) 
   {
    $vid="catalog"; 
    $zag="Наши товары"; 
    $sql="SELECT * FROM `tovar`,`tovar_types` WHERE `tovar`.`id_tovar_type`=".$_GET['type']." 
	AND `tovar_types`.`id_tovar_type`=`tovar`.`id_tovar_type`";
    if (isset($_GET['sort'])) 
      if ($_GET['sort']=='artic') $sql.=" ORDER BY `artic` ASC";
      else  $sql.=" ORDER BY `price` ASC";
  }
else 
  {
    $vid='popular'; 
    $zag='Топ продаж'; 
    $sql="SELECT * FROM `tovar`,`tovar_types` WHERE  `tovar_types`.`id_tovar_type`=`tovar`.`id_tovar_type` ORDER BY `sold` DESC LIMIT 5";
  }
?>
<strong><?=$zag;?></strong><br />
   <? 
   $color = "red";
    $q = mysqli_query($db, $sql);
	
 if (mysqli_num_rows($q)>0)
  {
	  echo ' <table width="100%" border="2" cellspacing="2" cellpadding="2">
        <tr>
		 <td width="30" bgcolor=#FFDAB9>&nbsp;</td>
		 <td width="60" align="center" bgcolor=#FFDAB9><font size=5>';
      if ($vid=='catalog') echo  '<a href="http://coffe-tea-shop.ru/?vid=catalog&type='.$_GET['type'].'&sort=artic">Артикул </font></a>';
      else echo 'Артикул</font>' ;
      echo '</td>
          <td width="140" align="center" bgcolor=#FFDAB9><font size=5>Фото</font></td>
          <td align="center" bgcolor=#FFDAB9><font size=5>Наименование</font></td>
          <td width="60" align="center" bgcolor=#FFDAB9><font size=5>';
      if ($vid=='catalog') echo  '<a href="http://coffe-tea-shop.ru/?vid=catalog&type='.$_GET['type'].'&sort=price">Цена, руб.</font></a>';
      else echo 'Цена, руб. </font>';
      echo '</td>
          <td width="40" align="center" bgcolor=#FFDAB9><font size=5>Кол.</font></td>
		  <td width="40" align="center" bgcolor=#FFDAB9><font size=5>Куп.</font></td>
        </tr>';
     $show=0; 

	 
   while ($row = mysqli_fetch_array($q,MYSQLI_ASSOC))
    {   
    if($vid=='catalog' and $show==0) {echo '
		<tr>
        <td colspan="8" align="center"><strong>'.$row['type'].'</strong></td>
        </tr>
        ';
        $show=1;}
      echo ' <tr>
          <td width="30" align="center"> ';
      if (isset ($_SESSION['id_client']))  echo '<a href="http://coffe-tea-shop.ru/edit_order.php?oper=add&artic='.$_GET['artic'].$row['artic'].'">';
      else  echo '<a href="http://coffe-tea-shop.ru/reg.php">';  
      echo '<img src="img/buy.gif" alt="в корзину" width="50" height="50" border="0"/></a></td>
          <td align="center"><font size=5>'.$row['artic'].'</font></td>
          <td align="center"><img src="img/mag/';
        if($row['foto_sm']=='N') echo 'nofoto';
        else echo $row['artic'];
        echo'.jpg" border="1" /></td>
          <td align="center"><font size=5>'.$row['name'].'</font></td>
          <td align="center">'.$row['price'].'</td>
          <td align="center">'.$row['amount'].'</td>
		  <td align="center">'.$row['sold'].'</td>
        </tr>
      ';
    }
    echo "</table>";
  }

    ?>
	  <p>&nbsp;</p><p>&nbsp;</p>
 <?php
  if (isset ($_SESSION['id_client']))
    {
    echo '
	<span class="style7">Корзина</span><br />
      <strong>Вы выбрали</strong><br />
      <table width="100%" border="1" cellspacing="0" cellpadding="2">
        <tr>
          <td width="30px" bgcolor="#FFDAB9>&nbsp;</td>
          <td width="80px" align="center" bgcolor="#FFDAB9  >Артикул</td>
          <td  align="center" bgcolor="#FFDAB9  >Наименование</td>
          <td width="25px" align="center" bgcolor="#FFDAB9 >уп.</td>
          <td width="60px" align="center" bgcolor="#FFDAB9 >Цена, руб.</td>
          <td width="50px" align="center" bgcolor="#FFDAB9 >Кол.</td>
          <td width="60px" align="center" bgcolor="#FFDAB9 >Сумма</td>
        </tr>';
    $sql="SELECT * FROM `tovar`,`purchase` WHERE `purchase`.`id_client`='".$_SESSION['id_client']."' AND `tovar`.`artic`=`purchase`.`artic` AND `purchase`.`id_order`=0";
	$q_buy = mysqli_query($db, $sql);     
    $sum = 0;
    while ($row_buy = mysqli_fetch_array($q_buy,MYSQLI_ASSOC))
    { 
    echo '<tr>
          <td width="30" align="center"><a href="http://coffe-tea-shop.ru/edit_order.php?oper=del&artic='.$row_buy['artic'].'"><img src="img/del.png" alt="в корзину" width="16" height="16"  border="0" /></a></td>
          <td align="center">'.$row_buy['artic'].'</td>
          <td>'.$row_buy['name'].'</td>
          <td align="center">';
          if ($row['box']!='') echo $row['box'];
          else echo "&nbsp;";
          echo '</td>
          <td align="center">'.$row_buy['price'].'</td>
          <td align="center">'.$row_buy['hm'].'</td>
          <td align="center">'.($row_buy['price']*$row_buy['hm']).'</td>
        </tr>';
    $sum += $row_buy['price']*$row_buy['hm'];
    }    
    echo '
		<tr><td colspan="7" align=right>
      <strong>Итого: '.$sum.' $ &nbsp; &nbsp;
	  <br><a href="http://coffe-tea-shop.ru/order.php">Оформить заказ</a></strong></td>
      </tr></table>';
    }
  
  ?>
  </body>
  </html>
<?php include("common/bottom.php");?>
