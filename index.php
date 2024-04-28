<?php
    /*Nesse if, a função 'isset' é usada para verificar se a variavel existe, nesse caso
    ele verificará se existe a função de $_POST['submit'], que seria o clique do usuário 
    no botão cadastrar para envio do formulário.*/ 
    if(isset($_POST['submit'])) {

        include_once('php/conexao.php'); //incluindo o arquivo de conexão com o bancco de dados
        session_start(); //iniciando uma sessão, para gerenciar sessões de usuários

            /*Aqui eu crio variaveis e dou o seu valor com base no que foi digitado pelo usuário,
            como por exemplo, o que foi digitado no input 'nome' do html, será atribuído a variável
            '$nome'. Estou fazendo essa atribuição para as variáveis para mais tarde inseri-las no 
            banco de dados*/
            $nome = $_POST['nome'];
            $data_nasc = $_POST['data_nasc'];
            $tel = $_POST['tel'];
            $endereco = $_POST['endereco'];
            $genero = $_POST['sexo'];

            //criando variavel para fazer consulta no banco de dados
            $sql = "SELECT * FROM pacientes WHERE nome = '$nome' and data_nasc = '$data_nasc'";

            /*aqui eu faço uma query (uma solicitação/consulta ao banco de dados), com o valor 
            da variavel que criei($sql)*/
            $result = $conexao->query($sql);

            /*Esse if verificará, a consulta que fiz com a query, se a quantidade de linhas < 1,
            calculado pela função 'mysqli_num_rows', quer dizer que aquele consulta não existe no 
            banco de dados.*/
            if(mysqli_num_rows($result) < 1) 
            {
                /*Com a informação de que não existe no banco de dados, eu insiro as informações digitadas
                pelo usuário ao banco de dados. Fazendo com que assim não tenha uma superlotação de dados 
                idênticos no banco de dados*/ 
                $resultado = mysqli_query($conexao, "INSERT INTO pacientes(nome, data_nasc, genero, telefone, endereco) 
                VALUES('$nome', '$data_nasc', '$genero', '$tel', '$endereco')");

                $_SESSION['msg'] = "<p style = 'color:green;'>Cadastro realizado com sucesso</p>";
            } 

            /*Se a quantiadade de linhas for >= 1, significa que existem aqueles dados no banco, então eu 
            não insiro os dados no banco de dados, e informo pro usuário que esse cadastro já existe*/
            else if (mysqli_num_rows($result) >= 1)
            {
                //unset para destruir/apagar o valor atribuído para a variável
                unset($_SESSION['nome']);
                unset($_SESSION['data_nasc']);
                unset($_SESSION['tel']);
                $_SESSION['msg'] = "<p style = 'color:red;'>Já existe cadastro com esse usuário</p>";
            }

    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>

    <!--Link css-->
    <link rel="stylesheet" href="css/estilo.css?v=<?= time() ?>" >

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

                <!--Aqui estou chamando no HTML a mensagem, caso o cadastro seja confirmado-->
                <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    } 
                
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                        header("Location: index.php"); //Redireciono o usuário para a mesma página
                    }
                ?> <!--E aqui estou chamando o cadastro já exista-->

                <!--Grupo de inputs-->
                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome completo:</label>
                        <input type="text" name="nome" id="nome" class="required" required oninput="validarNome()">
                        <span class="span-required">Nome tem que ter 3 ou mais caracteres!</span>
                    </div>
                    <div class="input-box">
                        <label for="tel">Telefone:</label>
                        <input type="tel" name="tel" id="tel" class="required" required placeholder="(XX)XXXXX-XXXX"  maxlength="11" oninput="validarTel()">
                        <span class="span-required">Incorreto! Coloque também o seu DDD!</span>
                    </div>
                    <div class="input-box">
                        <label for="data_nasc">Data Nascimento:</label>
                        <input type="date" name="data_nasc" id="data_nasc" required class="required" required>
                        <span class="span-required">Selecione sua data de nascimento</span>
                    </div>
                    <div class="input-box">
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" required class="required" oninput="validarEndereco()">
                        <span class="span-required">Digite um endereço valido!</span>
                    </div>
                </div>

                <!--Input de Gênero-->
                <div class="input-genero required">
                    <h6>Gênero: </h6>
                    <span class="span-required">Por favor, selecione o seu gênero!</span>
                    <div class="genero-group">
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
                            <input type="radio" name="sexo" id="nao_definido" value="nao_definido">
                            <label for="nao_definido">Prefiro não dizer</label>
                        </div>
                    </div>
                </div>

                <!--Botão-->
                <div class="btn-cadastrar">
                    <button type="submit" name="submit">Cadastrar</button>
                </div>

                <div class="link-cadastro-consulta">
                    <p>Para consultar pacientes cadastrados,</p><li><a href="consultarclientes.php">clique aqui</a></li>
                </div>

            </form>
        </div>
        
                  

    </div> <!--Fim Box principal-->

    <!--VALIDAÇÂO COM JAVASCRIPT-->
    <!--Fazendo ao final do arquivo, pois JAVASCRIPT é uma linguagem interpretada-->
    <script src="js/validacao.js"></script>
</body>


</html>