<ul class="pagination" id="myDIV">
    <!-- <li><a href="/public/catalog.php?name=<? echo $_GET['name']; ?>&id=<? echo $_GET['id']; ?>&page=1">1</a></li>
   <? if ($page > 1 && ($page - 1) !== 1) : ?>
        <li><a href="/public/catalog.php?name=<? echo $_GET['name']; ?>&id=<? echo $_GET['id']; ?>&page=<? echo ($page - 1); ?>"><<<? echo ($page - 1); ?></a></li>
    <? endif; ?>
    <? if ($page < $pageAll && ($page + 1) < $pageAll) : ?>
        <li><a href="/public/catalog.php?name=<? echo $_GET['name']; ?>&id=<? echo $_GET['id']; ?>&page=<? echo ($page + 1); ?>">Следующая</a></li>
    <? endif; ?>

    <li><a href="/public/catalog.php?name=<? echo $_GET['name']; ?>&id=<? echo $_GET['id']; ?>&page=<? echo $pageAll; ?>"><? echo $pageAll; ?></a></li>-->
    
    
    <? for ($p = 1; $p <= $pageAll; $p++) : ?>
        <?if($page==$p){
            $c="active";
        }else{
            $c="";
        }
        ;?>
        <li><a href="/public/catalog.php?name=<? echo $_GET['name']; ?>&id=<? echo $_GET['id']; ?>&page=<? echo $p; ?>" class=<? echo $c;?>><? echo $p; ?></a></li>
    <? endfor; ?>

</ul>

<script>
    

 
</script>