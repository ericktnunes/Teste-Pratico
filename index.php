<?php
    if(isset($_POST['submit'])) {

        include_once('php/conexao.php');

            $nome = $_POST['nome'];
            $data_nasc = $_POST['data_nasc'];
            $tel = $_POST['tel'];
            $endereco = $_POST['endereco'];
            $genero = $_POST['sexo'];

            $resultado = mysqli_query($conexao, "INSERT INTO pacientes(nome, data_nasc, genero, telefone, endereco) 
            VALUES('$nome', '$data_nasc', '$genero', '$tel', '$endereco')");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>

    <!--Link css-->
    <link rel="stylesheet" href="css/estilo.css">

</head>
<body>
    <!--Inicio Box principal-->
    <div class="box"> 

        <div class="form-img">
            <img src="imagens/imagemlogin.avif" alt="imagemlogin">
        </div>

        <div class="form">
            <form action="index.php" method="POST" id="form">

                <div class="form-titulo">
                    <h1>Cadastre-se</h1>
                </div>

                <!--Grupo de inputs-->
                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome completo:</label>
                        <input type="text" name="nome" id="nome" class="required" placeholder="Fulano..." required oninput="validarNome()">
                        <span class="span-required">Nome tem que ter 3 ou mais caracteres!</span>
                    </div>
                    <div class="input-box">
                        <label for="tel">Telefone:</label>
                        <input type="tel" name="tel" id="tel" class="required" placeholder="(XX)XXXXX-XXXX" required maxlength="11" oninput="validarTel()">
                        <span class="span-required quebrar-span">Incorreto! Coloque também o seu DDD!</span>
                    </div>
                    <div class="input-box">
                        <label for="data_nasc">Data Nascimento:</label>
                        <input type="date" name="data_nasc" id="data_nasc" class="required" required>
                        <span class="span-required">Selecione sua data de nascimento</span>
                    </div>
                    <div class="input-box">
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" class="required" required oninput="validarEndereco()">
                        <span class="span-required">Digite um endereço valido!</span>
                    </div>
                </div>

                <!--Input de Gênero-->
                <div class="input-genero">
                    <h6>Gênero: </h6>

                    <div class="genero-group" required>
                        <div class="genero-input">
                            <input type="radio" name="sexo" id="masc" value="masc">
                            <label for="masc">Masculino</label>
                        </div>
                        <div class="genero-input">
                            <input type="radio" name="sexo" id="fem" value="fem">
                            <label for="fem">Feminino</label>
                        </div>
                        <div class="genero-input">
                            <input type="radio" name="sexo" id="outros" value="outros">
                            <label for="outros">Outros</label>
                        </div>
                        <div class="genero-input">
                            <input type="radio" name="sexo" id="undefined" value="undefined">
                            <label for="undefined">Prefiro não dizer</label>
                        </div>
                    </div>
                </div>

                <!--Botão-->
                <div class="btn-cadastrar">
                    <button type="submit" name="submit">Cadastrar</button>
                </div>

            </form>
        </div>
        
                  

    </div> <!--Fim Box principal-->

    <!--VALIDAÇÂO COM JAVASCRIPT-->
    <!--Fazendo ao final do arquivo, pois JAVASCRIPT é uma linguagem interpretada-->
    <script src="js/validacao.js"></script>
</body>


</html>