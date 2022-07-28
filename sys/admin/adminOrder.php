<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$queryOrder = $db->query("SELECT `id`FROM `orders`"); ?>
                <select class="order-out">
                    <option data-id="0">Заказ</option>
                    <? foreach ($queryOrder as $row) { ?>
                        <option data-id="<? echo $row['id'] ?>"><? echo $row['id'] ?></option>
                    <? } ?>
                </select>