<?php
    /*Nesse if, a função 'isset' é usada para verificar se a variavel existe, nesse caso
    ele verificará se existe a função de $_POST['submit'], que seria o clique do usuário 
    no botão de consultar pacientes.*/ 
    if(isset($_POST['submit'])) {

        include_once('php/conexao.php'); //incluindo o arquivo de conexão com o bancco de dados
        session_start();  //iniciando uma sessão, para gerenciar sessões de usuários

            //atríbuo a variavel '$nome', o valor digitado pelo usuario no input 'nome' no HTML
            $nome = $_POST['nome'];

            //criando variavel para fazer consulta no banco de dados
            $sql = "SELECT * FROM pacientes WHERE nome = ?"; //Uso o "?" pois irei tratar o SQL Injection

            /*Como forma de segurança para combater o SQL Injection, eu usei funções myqsli do PHP
            que evitam com que seja usados métodos injection*/
            $stmt = $conexao->prepare($sql); //Crio a variavel '$stmt' e uso a função de preparar a query SQL  
            $stmt->bind_param('s', $nome);  //Aqui envio a variavel, para verificar se tem caracteres maliciosos, no caso a variavel '$nome'
            $stmt->execute(); //Função para executar a consulta
            $resultado = $stmt->get_result(); //Atribuo o resultado consultado para a variavel '$resultado'
            $stmt->close(); //Fechei a declaração como boa prática

                   
    } else {
            /*Esse else está aqui, pois se não existisse clique no  botão de pesquisar
            estava aparecendo a mensagem 'não existe cadastro com esse nome' e dando erro 
            de consulta na aplicação."*/
            include_once('php/conexao.php');
            session_start();

            //criando variavel para fazer consulta no banco de dados
            $sql = "SELECT * FROM pacientes WHERE nome = ?";

            $stmt = $conexao->prepare($sql);
            $stmt->bind_param('s', $nome);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $stmt->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>

    <!--Link css-->
    <link rel="stylesheet" href="css/estilo.css" >

</head>
<body>
    <!--Inicio Box principal-->
    <div class="box"> 

        <div class="form-img">
            <img src="imagens/imagemlogin.avif" alt="imagemlogin">
        </div>

        <div class="form">
            <form action="consultarclientes.php" method="POST" id="form">

                <div class="form-titulo">
                    <h1 style="">Consultar pacientes</h1>
                </div>


                <!--Grupo de inputs-->
                <div class="input-group">
                    <div class="input-box2">
                        <label for="nome">Digite o nome que deseja pesquisar:</label>
                        <input type="text" name="nome" id="nome" class="required">
                        <span class="span-required">Nome tem que ter 3 ou mais caracteres!</span>
                    </div>
                </div>

                <!--Botão-->
                <div class="btn-cadastrar">
                    <button type="submit" name="submit">Pesquisar</button>
                </div>
                
                <table class="tabela-consulta">
                    <thead>
                        <tr class="linhaprincipal">
                            <?php
                            /*Se o resultado da consulta der numero de linhas > 0, significa
                            que existe um cadastro com o nome digitado pelo usuário, ai eu retorno
                            com a criação dos títulos da tabela.*/
                            if($resultado->num_rows > 0){
                                echo "<th>Nome</th>";
                                echo "<th>Data de nascimento</th>";
                                echo "<th>Telefone</th>";
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                            <?php 
                                //Se existir clique no botão de pesquisar
                                if(isset($_POST['submit'])){
                                    if($resultado->num_rows > 0){
                                        /*Se o resultado da consulta der numero de linhas > 0, significa
                                        que existe um cadastro com o nome digitado pelo usuário, ai eu retorno
                                        com um While, que irá printar na tela, os pacientes digitado pelo usuário
                                        com sua respectiva data de nascimento e telefone*/
                                        while($paciente = $resultado->fetch_object()){
                                            //A função fetch_object busca uma linha de dados do conjunto de resultados e a retorna como um objeto.
                                            echo "<tr>";
                                            echo ("<td style='border-right: 1px solid #DEDEDE; text-align: center;'>" . $paciente->nome."</td>");
                                            echo ("<td style='border-right: 1px solid #DEDEDE; text-align: center;'>" . $paciente->data_nasc."</td>");
                                            echo ("<td>" . $paciente->telefone."</td>");
                                            echo "</tr>";
                                        }  
                                    } else {
                                        /*Caso o resultado da conuslta der numero de linhas < 0, significa que 
                                        não existe um cadastro com o nome digitado pelo usuário, ai eu dou um print
                                        na tela dizendo que 'não existe um cadastro com esse nome'*/
                                        echo "<tr>";
                                        echo "<td style='color: red;'>Não existe cadastro com esse nome!</td>";
                                        echo "</tr>";
                                    }   
                                }           
                            ?>
                    </tbody>
                </table>
                
                <div class="link-cadastro-consulta">
                    <p>Para cadastrar mais pacientes,</p><li><a href="index.php">clique aqui</a></li>
                </div>

            </form>
        </div>
        
                  

    </div> <!--Fim Box principal-->
    
</body>


</html>