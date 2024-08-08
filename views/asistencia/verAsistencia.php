<?php $estudiante = (!empty($_GET['estudiante'])) ? $_GET['estudiante'] : null;
if ($estudiante != null) { ?>
<input type="hidden" id="id" value="<?php echo $estudiante; ?>">
<div id="registro"></div>
<?php }else{
    echo 'PAGINA NO ENCONTRADA';
} ?>