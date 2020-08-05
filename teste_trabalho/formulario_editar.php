<?php
include"conexao.php";

$cod_usuario =	$_REQUEST['cod_usuario'];
$visualizar = "select cod_usuario, login, senha, nome, data_nasc, cpf, image from usuarios where cod_usuario= '$cod_usuario'";
$resultado = pg_exec($conecta , $visualizar);
while($linha = pg_fetch_row($resultado)){
    $cod_usuario   	= $linha[0];
    $login 			= $linha[1];
    $senha 			= $linha[2];
    $nome 			= $linha[3];
    $data    		= explode("-", $linha[4]);
    $data_nasc      = $data[2]."/".$data[1]."/".$data[0];
    $cpf			= $linha[5];
    $image          = $linha[6];
    if($image==""){
        $image = "avatar.png";
    }
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
			<h3>Editar</h3>
                    <div class="card-body">


                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                            <form method="post" action="" enctype="multipart/form-data" id="myform">
                                <div class='preview'>
                                <img src="image/<?php echo $image; ?>" width=80 height=80 >
                                </div>
                                <div >
                                    <input type="hidden" name="acao"   value="4">
                                    <input type="hidden" name="cod_usuario_image" id="cod_usuario_image"  value="<?php echo $cod_usuario; ?>">
                                    <input type="file" id="file" name="file" />
                                    <input type="button" class="button" value="Upload" id="but_upload">
                                </div>
                            </form>

                            
                        </div>

						<form method="post" action="salvar.php" id="validate">
                            <div class="form-group col-4">
                                <label for="InputNome">Nome do usuário</label>
                                <input type="text" name="nome" id="nome_edit" class="form-control" id="InputNome1" placeholder="Nome do usuario"  value="<?php echo $nome; ?>">
                                <input type="hidden" name="cod_usuario" id="cod_usuario" class="form-control" id="InputNome1" placeholder="Nome do usuario"  value="<?php echo $cod_usuario; ?>">
                            </div>
                            <div class="form-group col-4"">
                                <label for="exampleInputEmail1">Login do usuário</label>
                                <input type="text" id="login_edit" name="login_edit" class="form-control"  placeholder="Login do usuario"  id="login_user"  value="<?php echo $login; ?>">
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label for="Input">Data nasc</label>
                                    <input type="text" id="data_nasc_edit" name="data_nasc" class="form-control onlynumeric" id="numero" placeholder="Data Nascimento" value="<?php echo $data_nasc; ?>">
                                </div>
                                <div class="col-4">
                                    <label for="Input">CPF</label>
                                    <input type="text" id="CampoCPF_edit" name="CampoCPF" class="form-control" placeholder="CPF" value="<?php echo $cpf; ?>">
                                </div>
                            </div>

                            <div class="form-group col-4"">
                                <label for="labelInputPassword1">Senha</label>
                                <input type="password" id="senha_edit" name="senha" class="form-control" id="InputPassword1" placeholder="Senha">
                            </div>
                            <div class="form-group col-4"">
                                <label for="labelInputPassword1">Confirmar  Senha</label>
                                <input type="password" id="confirmesenha_edit" name="confirmesenha" class="form-control" id="exampleInputPassword2" placeholder="Confirma Senha">
                            </div>

                            </div>
							</form>
                    	<input type="button" id="submit_edit" class="readmore" value="Editar">
                        <input type="button" id="submit_cancela" class="readmore" value="Cancela">
                    </div>

		</div>
	</div>
												
</div>
<div class="hr">
</div>



<script src="javascripts/jquery.js"></script>
<script src="javascripts/jquery.validate.js"></script>

<script src="javascripts/jquery-maskedinput/jquery.maskedinput.js"></script>




<script type="text/javascript">
                        $("#img").attr("src","image/<?php echo $image; ?>"); 
                        $(".preview img").show(); // Display image element

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
		$("#data_nasc_edit").mask("99/99/9999");
		$("#CampoCPF_edit").mask("999.999.999-99");

		$("#validate").validate({                   
			rules:{
			CampoCPF_edit:{required: true, verificaCPF: true}
			},        
			messages:{
			CampoCPF_edit:{required: "Digite seu cpf", verificaCPF: "CPF inválido"},
			},                           	
		});        
		
        $("#but_upload").click(function(){

            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);

            $.ajax({
                url: 'executar.php?acao=4&cod_usuario_image='+$("#cod_usuario_image").val(),
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response != 0){
                        $("#img").attr("src",response); 
                        $(".preview img").show(); // Display image element
                    }else{
                        alert('file not uploaded');
                    }
                },
            });
        });


		$('#submit_cancela').click(function (e) {
			e.preventDefault();
			$('#mask').hide();
			$('.window').hide();
		});
        
        $( "#submit_edit" ).click(function() {
            var cod_usuario		= $("#cod_usuario").val();
            var nome			= $("#nome_edit").val();
            var login			= $("#login_edit").val();
			var cpf				= $("#CampoCPF_edit").val();
            var data_nasc		= $("#data_nasc_edit").val();
			var senha			= $("#senha_edit").val();
			var confirmesenha	= $("#confirmesenha_edit").val();

            if(cpf == ""){
                alert( "Preencha o CPF" );
                return false;
            }
            if(senha != confirmesenha){
                alert( "Senha não confere" );
                return false;
            }

            $.post('executar.php', {nome: nome, login: login, data_nasc: data_nasc, cpf: cpf, senha: senha, cod_usuario: cod_usuario, acao: 3 },function(resposta){
				if (resposta==1) {
					$("#nome").val("");
					$("#login").val("");
					$("#CampoCPF").val("");
					$("#data_nasc").val("");
					$("#senha").val("");
					$("#confirmesenha").val("");
                    window.location.reload();
                } else {
                    
                }

            });

        });
    });
    /**/
</script>

</body>
</html>
