<?php
    if(isset($_POST['submit'])) {

        include_once('php/conexao.php');
        session_start();

            $nome = $_POST['nome'];

            $sql = "SELECT * FROM pacientes WHERE nome = '$nome'";
            $resultado = $conexao->query($sql);
                   
    } else {
            include_once('php/conexao.php');
            session_start();

            $nome = "";
            $sql = "SELECT * FROM pacientes WHERE nome = '$nome'";
            $resultado = $conexao->query($sql);
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
                            if(mysqli_num_rows($resultado) >=1){
                                echo "<th>Nome</th>";
                                echo "<th>Data de nascimento</th>";
                                echo "<th>Telefone</th>";
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                            <?php 
                                if(isset($_POST['submit'])){
                                    if(mysqli_num_rows($resultado) >= 1){
                                        while($paciente = mysqli_fetch_assoc($resultado)){
                                            echo "<tr>";
                                            echo ("<td style='border-right: 1px solid #DEDEDE; text-align: center;'>" . $paciente['nome']."</td>");
                                            echo ("<td style='border-right: 1px solid #DEDEDE; text-align: center;'>" . $paciente['data_nasc']."</td>");
                                            echo ("<td>" . $paciente['telefone']."</td>");
                                            echo "</tr>";
                                        }  
                                    } else {
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