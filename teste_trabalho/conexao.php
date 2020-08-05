<?php
$conn_string = "host=localhost  port=5432 dbname=clinico user=postgres password=93156824";
$conecta = pg_connect($conn_string);

if(!$conecta){
echo "conexao falhou!!!!!!";
}else{
echo"";
}

?>
