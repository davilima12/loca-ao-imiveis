<?php 
session_start();
include_once("conexao.php");
$id = $_GET['id'];
$sql = "SELECT * FROM imoveis WHERE id = $id";
$resultado = mysqli_query($conexao,$sql);

$registro = mysqli_fetch_array($resultado);
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
    echo '<div style="text-align: center">';
    echo '<h1>Editar Imovel</h1>';
    echo '<form action="" method="POST">';
    echo '<label for="">Estado:</label>';
    echo '<input type="text" name="estado" id="estado" value="'.$registro['estado'].'"><br>';

    echo '<label for="">Cidade:</label>';
    echo '<input type="text" name="cidade" id="cidade" value="'.$registro['cidade'].'"><br>';

    echo '<label for="">Bairro:</label>';
    echo '<input type="text" name="bairro" id="bairro" value="'.$registro['bairro'].'"><br>';

    echo '<label for="">Rua:</label>';
    echo '<input type="text" name="rua" id="rua" value="'.$registro['rua'].'"><br>';

    echo '<label for="">Numero:</label>';
    echo '<input type="text" name="numero" id="numero" value="'.$registro['numero'].'"><br>';

    echo '<button type="submit" name="buttonEditar" value="buttonEditar">Editar</button>';
    echo '</form>';
    echo '</div>';

    $estado = $_POST['estado'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $rua = $_POST['rua'] ?? '';
    $numero = $_POST['numero'] ?? '';

    if($estado != '' && $cidade != '' && $bairro != '' && $rua != '' &&  $numero != '' && isset($_POST['buttonEditar'])){

        $query = "UPDATE imoveis SET estado = '$estado', cidade = '$cidade', bairro = '$bairro', rua = '$rua',numero = '$numero' WHERE id = $id";
        $resultadoQuery = mysqli_query($conexao, $query);
        if($resultadoQuery){
            header("Location: index.php");
            $_SESSION['msg'] = ' <h2 style=" color:green"> Imovel Editado Com Sucesso </h2>';
                
        }else{
            $_SESSION['msg'] = ' <h2 style=" color:red"> Error Ao Tentar Editar UM Imovel </h2>' ;
        }
    }else if($estado == '' || $cidade == '' || $bairro == '' || $rua == '' ||  $numero == '' && isset($_POST['buttonEditar']) ){
        $_SESSION['msg'] = ' <h2 style=" color:red"> Error Algum Campo Em Branco </h2>';
    }
