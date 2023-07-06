<?php
include_once('Layout/header.php');
?>
<div id="content" class="app-content">
     <div class="row g-3">
<?php
foreach($map as $img){
     ?>
     <img src="<?=PUBLIC_URL?>/<?=$img?>" class="w-10"/>
     <?php
}
          
?> 
</div>
</div>

<?php
include_once('Layout/footer.php');
?>