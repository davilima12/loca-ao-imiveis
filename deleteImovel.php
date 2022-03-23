<?php 
session_start();
include_once("conexao.php");
$id = $_GET['id'];
$sql = "DELETE FROM imoveis WHERE id = $id";
$resultado = mysqli_query($conexao,$sql);

if(mysqli_affected_rows($conexao)){
    header("Location: index.php");
    $_SESSION['msg'] = ' <h2 style=" color:green"> Imovel Removido Com Sucesso </h2>';
    
}else{
    header("Location: index.php");
    $_SESSION['msg'] = ' <h2 style=" color:red"> Error ao tentar Apagar Um Imovel </h2>'; 
}
