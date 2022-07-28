<ul class="pagination" id="myDIV">
    
    <? $filename = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME); ?>

    <? for ($p = 1; $p <= $pageAll; $p++) : ?>
        <? if ($page == $p) {
            $c = "active";
        } else {
            $c = "";
        }; ?>
        <li><a href="/catalog/<? echo $filename; ?>.php?name=<? echo $_GET['name']; ?>&id=<? echo $_GET['id']; ?>&page=<? echo $p; ?>" class=<? echo $c; ?>><? echo $p; ?></a></li>
    <? endfor; ?>

</ul>

<script>



</script>