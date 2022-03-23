<?php

namespace App;
class Api{

    public static function buscarCep($dados){
        if(isset($_POST['cepPesquisar'])){
            if($dados['cep'] != ''){
                $cep = $dados['cep'] ?? null;
                $url = "https://viacep.com.br/ws/{$cep}/json/";
                $endereco = json_decode(file_get_contents($url)) ;
                return $endereco;
            }else{
                $_SESSION['msg'] = ' <h2 style=" color:red"> Cep Invalido </h2>';
            }

        }

    }

    public static function locacao($dados){

        include_once("conexao.php");
        $estado = $dados['estado'] ?? '';
        $cidade = $dados['cidade'] ?? '';
        $bairro = $dados['bairro'] ?? '';
        $rua = $dados['rua'] ?? '';
        $numero = $dados['numero'] ?? '';

        if($estado != '' && $cidade != '' && $bairro != '' && $rua != '' &&  $numero != '' && isset($dados['button']) ){

            $query = "INSERT INTO imoveis(estado,cidade,bairro,rua,numero) VALUES('$estado','$cidade','$bairro','$rua','$numero')";
            $resultadoQuery = mysqli_query($conexao, $query);
            if($resultadoQuery){
                $_SESSION['msg'] = ' <h2 style=" color:green"> Imovel Cadastrado Com Sucesso </h2>';
                    
            }else{
                $_SESSION['msg'] = ' <h2 style=" color:red"> Error No Cadastro </h2>' ;
            }
        }else if(isset($dados['button'])){
            if($estado == ''){
                $_SESSION['msg'] = ' <h2 style=" color:red"> Por Favor Digite Um Estado </h2>'; 
            }
            if($cidade == ''){
                $_SESSION['msg'] = ' <h2 style=" color:red"> Por Favor Digite Uma Cidade </h2>'; 
            }
            if($bairro == ''){
                $_SESSION['msg'] = ' <h2 style=" color:red"> Por Favor Digite Um Bairro </h2>'; 
            }
            if($rua == ''){
                $_SESSION['msg'] = ' <h2 style=" color:red"> Por Favor Digite Uma Rua </h2>'; 
            }
            if($numero == ''){
                $_SESSION['msg'] = ' <h2 style=" color:red"> Por Favor Digite Um Numero </h2>'; 
            }
            
        }
    }


}


