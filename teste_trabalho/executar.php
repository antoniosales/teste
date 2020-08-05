<?php
include "conexao.php";

$acao			=	$_REQUEST['acao'];

if($acao==1){
	$nome			=	$_REQUEST['nome'];
	$login			=	$_REQUEST['login'];
	$cpf			=	$_REQUEST['cpf'];
	$data			=	explode("/", $_REQUEST['data_nasc']);
	$data_nasc		=   $data[2]."-".$data[1]."-".$data[0];
	$senha			=	$_REQUEST['senha'];	
	$res =  "insert into usuarios ( nome,login,senha,data_nasc,cpf)values('$nome','$login','$senha','$data_nasc','$cpf')";
	$result = pg_exec($conecta , $res);
	if($result){
		echo 1;
	}
}

if($acao==2){
	$cod_usuario =	$_REQUEST['cod_usuario'];
	$delete = "delete from usuarios where cod_usuario= '$cod_usuario'";
	$result = pg_exec($conecta , $delete);
	if($result){
		echo 1;
	}
}

if($acao==3){
	$cod_usuario =	$_REQUEST['cod_usuario'];
	$nome			=	$_REQUEST['nome'];
	$login			=	$_REQUEST['login'];
	$cpf			=	$_REQUEST['cpf'];
	$data			=	explode("/", $_REQUEST['data_nasc']);
	$data_nasc		=   $data[2]."-".$data[1]."-".$data[0];
	$senha			=	$_REQUEST['senha'];	
	$update = "update usuarios set  nome='$nome',login='$login',senha='$senha',data_nasc='$data_nasc',cpf='$cpf' where cod_usuario= '$cod_usuario'";
	$result = pg_exec($conecta , $update);
	if($result){
		echo 1;
	}
}

if($acao==4){

		$filename = $_FILES['file']['name'];
		$cod_usuario =	$_REQUEST['cod_usuario_image'];
		$location = "image/".$filename;
		$uploadOk = 1;
		$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		$valid_extensions = array("jpg","jpeg","png");
		if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
		$uploadOk = 0;
		}

		if($uploadOk == 0){
			echo 0;
		}else{
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){

				$update = "update usuarios set  image='$filename' where cod_usuario= '$cod_usuario'";
				$result = pg_exec($conecta , $update);				
				echo $location;
			}else{
				echo 0;
			}
		}
}

if($acao=='5'){

	$cod_sintoma		= $_REQUEST['cod_sintoma']; 
	$cod_usuario		= $_REQUEST['cod_usuario']; 
	$febre				= $_REQUEST['febre']; 
	$coriza				= $_REQUEST['coriza'];
	$nariz				= $_REQUEST['nariz'];
	$cansaco			= $_REQUEST['cansaco'];
	$tosse				= $_REQUEST['tosse'];
	$dorcabeca			= $_REQUEST['dorcabeca'];
	$dorescorpo			= $_REQUEST['dorescorpo'];
	$malestar			= $_REQUEST['malestar'];
	$dorgarganta		= $_REQUEST['dorgarganta'];
	$respirar			= $_REQUEST['respirar'];
	$paladar			= $_REQUEST['paladar'];
	$olfato				= $_REQUEST['olfato'];
	$locomocao			= $_REQUEST['locomocao'];
	$diarreia			= $_REQUEST['diarreia'];

	if($cod_sintoma){
		$res = "update sintoma set  
				cod_usuario='$cod_usuario',
				febre='$febre',
				coriza='$coriza',
				nariz='$nariz',
				cansaco='$cansaco',
				tosse='$tosse',
				dorcabeca='$dorcabeca', 
				dorescorpo='$dorescorpo',
				malestar='$malestar',
				dorgarganta='$dorgarganta',
				respirar='$respirar',
				paladar='$paladar',
				olfato='$olfato',
				locomocao='$locomocao',
				diarreia='$diarreia'
				where cod_sintoma= '$cod_sintoma'";
	}else{
		$res =  "insert into sintoma 
		(
			cod_usuario, 
			febre, 
			coriza, 
			nariz, 
			cansaco, 
			tosse,
			dorcabeca,
			dorescorpo,
			malestar,
			dorgarganta,
			respirar,
			paladar,
			olfato,
			locomocao,
			diarreia
		)
		values
		(
			'$cod_usuario', 
			'$febre', 
			'$coriza', 
			'$nariz', 
			'$cansaco', 
			'$tosse',
			'$dorcabeca',
			'$dorescorpo',
			'$malestar',
			'$dorgarganta',
			'$respirar',
			'$paladar',
			'$olfato',
			'$locomocao',
			'$diarreia'
		)";

	}
	$result = pg_exec($conecta , $res);
	if($result){
		echo 1;
	}

}

?>