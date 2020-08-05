<?php
include"conexao.php";

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
 
 #mask {
   position:absolute;
   left:0;
   top:0;
   z-index:9000;
   background-color:#ffffff;
   display:none;
 }
   
 #boxes .window {
   position:absolute;
   left:0;
   top:0;
   width:540px;
   height:200px;
   display:none;
   z-index:9999;
   padding:20px;
 }
  
 #boxes #dialog2 {
   background:transparent; 
   width:500px;
   margin:0 auto;
   margin-top:-160px;
   margin-left:-260px;
   
 }
  #conteudo{
	  border-style: solid;
  }

 .close{display:block; text-align:right;}
  
 </style>

</head>
<body>


<!-- Modal -->
<div id="boxes">
 
 	<!-- Janela Modal -->
		 <div id="dialog2" class="window">
				 
				 <div id="conteudo"></div>
				 
			 </div>
	<!-- Fim Janela Modal-->
	
	<!-- Máscara para cobrir a tela -->
	<div id="mask"></div>
  
 </div>


<div class="row">
	<div class="headerlogo four columns">
		<div class="logo">

		</div>
	</div>
	<div class="headermenu eight columns noleftmarg">

	</div>
</div>
<div class="clear">
</div>

<div class="row">
	<!-- CONTACT FORM -->
	<div class="ten columns">
		<div class="wrapcontact">
			<h3>Cadastro</h3>
                    <div class="card-body">
						<form method="post" action="salvar.php" id="validate">
                            <div class="form-group">
                                <label for="InputNome">Nome do usuário</label>
                                <input type="text" name="nome" id="nome" class="form-control" id="InputNome1" placeholder="Nome do usuario"  value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Login do usuário</label>
                                <input type="text" id="login" name="login" class="form-control"  placeholder="Login do usuario"  id="login_user"  value="">
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label for="InputNumero">Data nasc</label>
                                    <input type="text" id="data_nasc" name="data_nasc" class="form-control onlynumeric" id="numero" placeholder="Data Nascimento" value="">
                                </div>
                                <div class="col-4">
                                    <label for="InputEndereco">CPF</label>
                                    <input type="text" id="CampoCPF" name="CampoCPF" class="form-control" placeholder="CPF" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="labelInputPassword1">Senha</label>
                                <input type="password" id="senha" name="senha" class="form-control" id="InputPassword1" placeholder="Senha">
                            </div>
                            <div class="form-group">
                                <label for="labelInputPassword1">Confirmar  Senha</label>
                                <input type="password" id="confirmesenha" name="confirmesenha" class="form-control" id="exampleInputPassword2" placeholder="Confirma Senha">
                            </div>

                            </div>
							</form>
                    	<input type="button" id="submit" class="readmore" value="Gravar">
                    </div>

					<div class="card-body">
							<table id="tabela" class="table table-bordered table-striped">

								<thead>
								<tr>
									<th>Código</th>
									<th>Nome</th>
									<th>CPF</th>
									<th>Situação </th>
									<th width="20%"></th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$visualizar = "select cod_usuario, login, senha, nome, data_nasc, cpf from usuarios order by cod_usuario";
								$resultado = pg_exec($conecta , $visualizar);
								while($linha = pg_fetch_row($resultado)){
									$cod_usuario   	= $linha[0];
									$login 			= $linha[1];
									$senha 			= $linha[2];
									$nome 			= $linha[3];
									$data_nasc 		= $linha[4];
									$cpf			= $linha[5];

									$porcentagem = "0";
									$visualizar_sintoma = "select cod_usuario, sum(febre+coriza+nariz+cansaco+tosse+dorcabeca+dorescorpo+malestar+dorgarganta+respirar+paladar+olfato+locomocao+diarreia) as total from sintoma where cod_usuario = '$cod_usuario'  group by cod_usuario";
									$resultado_sintoma = pg_exec($conecta , $visualizar_sintoma);
									while($linha_sintoma = pg_fetch_row($resultado_sintoma)){
										$total 			= $linha_sintoma[1];
										$porcentagem = ($total * 100 / 14);
									}
									
									if($porcentagem <= 10){
										$situacao = "Sintomas insuficientes";
									}else if($porcentagem > 40 and  $porcentagem <= 60){
										$situacao = "Pontecial infectado";

									}else if($porcentagem > 60){
										$situacao = "Possivel infectado";

									}



								?>


									<tr>
										<td><?php echo $cod_usuario; ?></td>
										<td><?php echo $nome; ?></td>
										<td><?php echo $cpf; ?></td>
										<td><?php echo $situacao; ?></td>
										<td>
											<div class="row">

												<div class="col-sm-6">
												<a href="javascript:void(0)" id="ficha-<?php echo $cod_usuario; ?>" class="btn-sm btn-outline-primary ficha"  data-toggle="modal" data-target="#modalExemplo" >
													<i class="fa fa-file" style="font-size:16px"></i>
												</a>
												</div>

												<div class="col-sm-6">
												<a href="javascript:void(0)" id="editar-<?php echo $cod_usuario; ?>" class="btn-sm btn-outline-primary editar"  data-toggle="modal" data-target="#modalExemplo" >
													<i class="fa fa-edit" style="font-size:16px"></i>
												</a>
												</div>
												<div class="col-sm-6">
												<a href="javascript:void(0)" id="excluir-<?php echo $cod_usuario; ?>" class="btn-sm btn-outline-danger confirmation excluir"  data-bb-handler="confirm" data-mensagem="Deseja excluir esse registro">
													<i class="fa fa-trash" style="font-size:16px"></i>
												</a>
												</div>


											</div>
										</td>
									</tr>
								<?php
								}
								?>
								</tbody>
							</table>
						</div>

		</div>
	</div>
												
</div>
<div class="hr">
</div>

<div id="footer">
	<footer class="row">


	</footer>
</div>
<div class="copyright">
	<div class="row">
		<div class="six columns">
			 &copy;<span class="small"> Copyright 2020 Antonio Sales</span>
		</div>
		<div class="six columns">
			<!--<span class="small floatright"> Template by <a href="www.wowthemes.net">WowThemes.net</a></span> -->
		</div>
	</div>
</div>


<script src="javascripts/jquery.js"></script>
<script src="javascripts/jquery.validate.js"></script>

<!-- DataTables -->
<script src="javascripts/datatables/jquery.dataTables.min.js"></script>
<script src="javascripts/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="javascripts/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="javascripts/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="javascripts/jquery-maskedinput/jquery.maskedinput.js"></script>




<script type="text/javascript">
	jQuery.validator.addMethod("verificaCPF", function(value, element) {

	value = value.replace('.','');

	value = value.replace('.','');

	cpf = value.replace('-','');

	while(cpf.length < 11) cpf = "0"+ cpf;

	var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;

	var a = [];

	var b = new Number;

	var c = 11;

	for (i=0; i<11; i++){

		a[i] = cpf.charAt(i);

		if (i < 9) b += (a[i] * --c);

	}

	if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }

	b = 0;

	c = 11;

	for (y=0; y<10; y++) b += (a[y] * c--);

	if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

	if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;

	return true;

}, "Informe um CPF válido."); 


    $(document).ready(function() {
		$("#data_nasc").mask("99/99/9999");
		$("#CampoCPF").mask("999.999.999-99");
        $("#tabela").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "nenhum Registro encontrado",
                "info": "Exibir página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum Registro",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                }
            }
        });
		
		$("#validate").validate({                   
			rules:{
			CampoCPF:{required: true, verificaCPF: true}
			},        
			messages:{
			CampoCPF:{required: "Digite seu cpf", verificaCPF: "CPF inválido"},
			},                           	
		});        
		
		$( ".editar" ).click(function() {

			var arr = $(this).attr("id").split('-');
			load_modal('formulario_editar.php?cod_usuario='+arr[1]);

		});
		$( ".ficha" ).click(function() {

			var arr = $(this).attr("id").split('-');
			load_modal('formulario_ficha.php?cod_usuario='+arr[1]);

		});
		function load_modal(url){
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			$('#mask').css({'width':maskWidth,'height':maskHeight});
	
			$('#mask').fadeIn(1000);	
			$('#mask').fadeTo("slow",0.8);
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
				
			$('#dialog2').css('top',  winH/2-$('#dialog2').height()/2);
			$('#dialog2').css('left', winW/2-$('#dialog2').width()/2);
		
			$('#dialog2').fadeIn(2000); 
			
			$('#conteudo').load(url);

		}



		$( ".excluir" ).click(function() {
			var arr = $(this).attr("id").split('-');
			result = confirm("Deseja ecluir esse registro");
			if(result){
				var cod_usuario = arr[1];
				$.post('executar.php', {cod_usuario: cod_usuario, acao: 2 },function(resposta){
				if (resposta==1) {
					window.location.reload();
                }

            });
				alert(arr[0]);

			}
		});

        $( "#submit" ).click(function() {
            var nome			= $("#nome").val();
            var login			= $("#login").val();
			var cpf				= $("#CampoCPF").val();
            var data_nasc		= $("#data_nasc").val();
			var senha			= $("#senha").val();
			var confirmesenha	= $("#confirmesenha").val();

            if(cpf == ""){
                alert( "Preencha o CPF" );
                return false;
            }
            if(senha != confirmesenha){
                alert( "Senha não confere" );
                return false;
            }

            $.post('executar.php', {nome: nome, login: login, data_nasc: data_nasc, cpf: cpf, senha: senha, acao: 1 },function(resposta){
				if (resposta==1) {
					$("#nome").val("");
					$("#login").val("");
					$("#CampoCPF").val("");
					$("#data_nasc").val("");
					$("#senha").val("");
					$("#confirmesenha").val("");
					window.location.reload();
                } 

            });

        });
    });
    /**/
</script>

</body>
</html>
