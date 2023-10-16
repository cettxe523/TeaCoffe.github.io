<?php
session_start();
include("common/func.php");
bd_connect();
mysqli_query($db,"INSERT INTO `orders` VALUES ('','".$_SESSION['id_client']."')");
$q_lo = mysqli_query($db,"SELECT `id_order` FROM `orders` WHERE `id_client`=".$_SESSION['id_client']." ORDER BY `id_order` DESC LIMIT 1");
$row_lo = mysqli_fetch_array($q_lo,MYSQLI_NUM);
mysqli_query($db,"UPDATE `purchase`,`tovar` SET `purchase`.`id_order`='".$row_lo[0]."',`tovar`.`sold`=`tovar`.`sold`+1  WHERE `purchase`.`id_client`='".$_SESSION['id_client']."'  AND `purchase`.`artic`=`tovar`.`artic` AND `purchase`.`id_order`=0");
//mysql_query("UPDATE `purchase` SET `id_order`='".$row_lo[0]."' WHERE `id_client`='".$_SESSION['id_client']."' AND `id_order`=0");
include("common/top.php");
?>
			Заказ оформлен.
<?php include("common/bottom.php");?>

