<?php
session_start();
include("common/func.php");
bd_connect();
?>
<link href="img/icon.ico" rel="shortcut icon" type="image/x-icon"/>
<?
include("common/top.php");
?>
<center>
<h1>Магазин "Чай-Кофе"</h1>

<?
include("common/table.php");
?>
<h2>г.Москва, ул. Индустриальная, д. 7А<br> ТЕЛ. +7 (444) 555 77 00&nbsp;ФАКС +7 (444) 555 77 33/88<br>
Проезд до остановки «ТК Центральный»<br>

<table>
<tr>
Доставка:</tr>

<ul> 
<tr><li>по всей Москве;</tr>
<tr><li>круглосуточно;</tr>
<tr><li>бесплатно;</tr>
<tr><li>за черту города Москва при минимальном заказе от 10000 руб.</tr>
</ul> 
</table></center>
</h2></p>

<?php include("common/bottom.php");?>

