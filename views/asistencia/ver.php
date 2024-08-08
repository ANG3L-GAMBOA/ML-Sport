<?php $carrera = (!empty($_GET['carrera'])) ? $_GET['carrera'] : null;
$nivel = (!empty($_GET['nivel'])) ? $_GET['nivel'] : null;
if ($carrera != null && $nivel != null) { ?>
<input type="hidden" id="carrera" value="<?php echo $carrera; ?>">
<input type="hidden" id="nivel" value="<?php echo $nivel; ?>">
<div id="registro"></div>
<?php }else{
    echo 'PAGINA NO ENCONTRADA';
} ?>