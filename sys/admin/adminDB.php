<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$query = $db->query("SELECT `id`,`name`FROM `good`"); ?>
<select class="good-out">
    <option data-id="0">Новый товар</option>
    <? foreach ($query as $row) { ?>
        <option data-id="<? echo $row['id'] ?>"><? echo $row['name'] ?></option>
    <? } ?>
</select>