<?php
include"conexao.php";


$cod_usuario =	$_REQUEST['cod_usuario'];
$visualizar = "select s.cod_sintoma, s.cod_usuario, s.febre, s.coriza, s.nariz, s.cansaco, s.tosse, s.dorcabeca, s.dorescorpo, s.malestar, s.dorgarganta, s.respirar, s.paladar, s.olfato, s.locomocao, s.diarreia, u.nome from usuarios as u left join sintoma as s on s.cod_usuario=u.cod_usuario where u.cod_usuario='$cod_usuario'";
$resultado = pg_exec($conecta , $visualizar);
while($linha = pg_fetch_row($resultado)){


    $cod_sintoma    = $linha[0];
    $febre          = $linha[2];
    $coriza         = $linha[3];
    $nariz          = $linha[4];
    $cansaco        = $linha[5];
    $tosse          = $linha[6];
    $dorcabeca      = $linha[7];
    $dorescorpo     = $linha[8];
    $malestar       = $linha[9];
    $dorgarganta    = $linha[10];
    $respirar       = $linha[11];
    $paladar        = $linha[12];
    $olfato         = $linha[13];
    $locomocao      = $linha[14];
    $diarreia       = $linha[15];
    $nome           = $linha[16];

}


?>

<!DOCTYPE html>

<html class="no-js" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width"/>
<title>Teste</title>
<link rel="stylesheet" href="stylesheets/style.css">
<link rel="stylesheet" href="stylesheets/skins/manaca.css">
<link rel="stylesheet" href="stylesheets/responsive.css">
<link rel="stylesheet" href="stylesheets/bootstrap.css">
<style type="text/css">
/* Container */
.container{
   margin: 0 auto;
   border: 0px solid black;
   width: 50%;
   height: 250px;
   border-radius: 3px;
   background-color: ghostwhite;
   text-align: center;
}
/* Preview */
.preview{
   width: 80px;
   height: 80px;
   border: 1px solid black;
   margin: 0 auto;
   background: white;
}

.preview img{
   display: none;
}
/* Button */
.button{
   border: 0px;
   background-color: deepskyblue;
   color: white;
   padding: 5px 15px;
   margin-left: 10px;
}
</style>


</head>
<body>


<div class="clear">
</div>

<div class="row">
	<!-- CONTACT FORM -->
	<div class="ten columns">
		<div class="wrapcontact">
			<h3>Sintomas <b><?php echo  $nome; ?></b></h3>
                    <div class="card-body">


						<form method="post" action="salvar.php" id="validate">
                        <input type="hidden" name="cod_usuario" id="cod_usuario"  value="<?php echo $cod_usuario; ?>">
                        <input type="hidden" name="cod_sintoma" id="cod_sintoma"  value="<?php echo $cod_sintoma; ?>">
                            <div class="checkbox">

                                <input type="checkbox" name="febre" id="febre" <?php if($febre=='1') { echo " checked "; } ?> >
                                <label for="defaultUnchecked">Febre</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  name="coriza" id="coriza" <?php if($coriza=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Coriza</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  name="nariz" id="nariz" <?php if($nariz=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Nariz entupido</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="cansaco" <?php if($cansaco=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Cansaço</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="tosse" <?php if($tosse=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Tosse</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="dorcabeca" <?php if($dorcabeca=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Dor de cabeça</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox"  id="dorescorpo" <?php if($dorescorpo=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Dores no corpo</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox"  id="malestar" <?php if($malestar=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Mal estar geral</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox"  id="dorgarganta" <?php if($dorgarganta=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Dor de garganta</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox"  id="respirar" <?php if($respirar=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Dificuldade de respirar</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="paladar" <?php if($paladar=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Falta de paladar</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="olfato" <?php if($olfato=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Falta de olfato</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="locomocao" <?php if($locomocao=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Dificuldade de locomoção</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox"  id="diarreia" <?php if($diarreia=='1') { echo " checked "; } ?>>
                                <label  for="defaultUnchecked">Diarréia</label>
                            </div>

							</form>
                    	<input type="button" id="submit_ficha" class="readmore" value="Cadastra">
                        <input type="button" id="submit_cancela" class="readmore" value="Cancela">
                    </div>

		</div>
	</div>
												
</div>
<div class="hr">
</div>



<script src="javascripts/jquery.js"></script>
<script src="javascripts/jquery.validate.js"></script>

<script type="text/javascript">
		$('#submit_cancela').click(function (e) {
			e.preventDefault();
			$('#mask').hide();
			$('.window').hide();
		});

        $( "#submit_ficha" ).click(function() {
            if($("#febre").is(':checked')){
                var febre = '1';
            } else {
                var febre = '0';
            }
            if($("#coriza").is(':checked')){
                var coriza = '1';
            } else {
                var coriza = '0';
            }
            if($("#nariz").is(':checked')){
                var nariz = '1';
            } else {
                var nariz = '0';
            }
            if($("#cansaco").is(':checked')){
                var cansaco = '1';
            } else {
                var cansaco = '0';
            }
            if($("#tosse").is(':checked')){
                var tosse = '1';
            } else {
                var tosse = '0';
            }
            if($("#dorcabeca").is(':checked')){
                var dorcabeca = '1';
            } else {
                var dorcabeca = '0';
            }
            if($("#dorescorpo").is(':checked')){
                var dorescorpo = '1';
            } else {
                var dorescorpo = '0';
            }
            if($("#malestar").is(':checked')){
                var malestar = '1';
            } else {
                var malestar = '0';
            }
            if($("#dorgarganta").is(':checked')){
                var dorgarganta = '1';
            } else {
                var dorgarganta = '0';
            }
            if($("#respirar").is(':checked')){
                var respirar = '1';
            } else {
                var respirar = '0';
            }
            if($("#paladar").is(':checked')){
                var paladar = '1';
            } else {
                var paladar = '0';
            }
            if($("#olfato").is(':checked')){
                var olfato = '1';
            } else {
                var olfato = '0';
            }
            if($("#locomocao").is(':checked')){
                var locomocao = '1';
            } else {
                var locomocao = '0';
            }
            if($("#diarreia").is(':checked')){
                var diarreia = '1';
            } else {
                var diarreia = '0';
            }            
            var cod_sintoma   = $("#cod_sintoma").val();
            var cod_usuario   = $("#cod_usuario").val();

            $.post('executar.php', {
                    cod_sintoma: cod_sintoma, 
                    cod_usuario: cod_usuario, 
                    febre: febre, 
                    coriza: coriza, 
                    nariz: nariz, 
                    cansaco: cansaco, 
                    tosse: tosse,
                    dorcabeca: dorcabeca,
                    dorescorpo: dorescorpo,
                    malestar: malestar,
                    dorgarganta: dorgarganta,
                    respirar: respirar,
                    paladar: paladar,
                    olfato: olfato,
                    locomocao: locomocao,
                    diarreia: diarreia,
                    acao: 5 
                    
                },function(resposta){
				if (resposta==1) {
                    window.location.reload();
                } 

            });

        });




    /**/
</script>

</body>
</html>
