<?php 
session_start();
require __DIR__.'/vendor/autoload.php';

use App\Api;

$dados =  $_POST;
$valores = Api::buscarCep($dados);
$cadastro = Api::locacao($dados);
?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title></title>
 </head>
 <body>


<div style="text-align: center;">
    
     <div id="conteudo" style="display: inline-block; margin:0px; text-align: center; background-color:silver">
            <h1>Busque Imoveis Para Locação</h1>
    
            <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
    
            ?>
    
            <form action="." method="POST">
                <input type="text" name="cep" id="cep" placeholder="Digite Um Cep">
    
                <button type="submit" name="cepPesquisar">Pesqusiar</button>
            </form><br>
    
            <form action="." method="POST">
                <label for="">Estado:</label>
                <input type="text" name="estado" id="estado" value="<?php echo $valores->uf ?? null  ?>"><br>
    
                <label for="">Cidade:</label>
                <input type="text" name="cidade" id="cidade" value="<?php echo $valores->localidade ?? null  ?>"><br>
    
                <label for="">Bairro:</label>
                <input type="text" name="bairro" id="bairro" value="<?php echo $valores->bairro ?? null ?>"><br>
    
                <label for="">Rua:</label>
                <input type="text" name="rua" id="rua" value="<?php echo $valores->logradouro ?? null  ?>"><br>
    
                <label for="">Numero:</label>
                <input type="text" name="numero" id="numero"><br>
    
                <button type="submit" name="button" value="button">Locar Imovel</button>
            </form>
    
        </div>
    
        <div style="display: inline-block; margin:0 px">
    
        <?php
        echo '<table border=1>';
        echo "<tr>";
        echo "<th>ESTADO</th>";
        echo "<th>CIDADE</th>";
        echo "<th>BAIRRO</th>";
        echo "<th>RUA</th>";
        echo "<th>NUMERO</th>";
        echo "</tr>";
        
        include("conexao.php");

        $sql = "SELECT * FROM imoveis";
        $resultado = mysqli_query($conexao,$sql);
    
        while ($registro = mysqli_fetch_array($resultado))
        {
            $id = $registro['id'];
            echo "<tr>";
            echo "<td>".$registro['estado']."</td>";
            echo "<td>".$registro['cidade']."</td>";
            echo "<td>".$registro['bairro']."</td>";
            echo "<td>".$registro['rua']."</td>";
            echo "<td>".$registro['numero']."</td>";
            echo "<td> <a href='editarImovel.php?id=".$id."'>Editar</a></td>";
            echo "<td> <a href='deleteImovel.php?id=".$id."'>Deletar</a> </td>";
            echo "</tr>";
        }
        mysqli_close($conexao);
        echo "</table>";
     ?>
    </div>
</div>

   



 </body>
 </html>