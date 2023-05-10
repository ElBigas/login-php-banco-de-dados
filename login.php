<?php 
    session_start();

    // Verifica se os dados foram enviados corretamente
    if(empty($_POST) or (empty($_POST["usuario"]) or (empty($_POST["senha"])))) {
        print "<script>alert('Usuário ou senha vazio!')</script>";
        print "<script>location.href='index.php';</script>";
    }

    // Conexão com o banco de dados
    include('config.php');

    // Recupera os dados enviados pelo formulário
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Consulta SQL para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios
            WHERE usuario = '{$usuario}'
            AND senha = '{$senha}' ";

    // Executa a consulta SQL
    $res = $conn->query($sql) or die($conn->error);

    // Verifica se o usuário foi encontrado
    $row = $res->fetch_object();

    $qtd = $res->num_rows;

    if($qtd > 0){

        // Inicia a sessão e guarda os dados do usuário
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nome"] = $row->nome;
        $_SESSION["tipo"] = $row->tipo;
        print "<script>location.href='dashboard.php';</script>";

    }else{

        // Exibe uma mensagem de erro e redireciona o usuário para a página inicial
        print "<script>alert('Usuário ou senha incorretos!')</script>";
        print "<script>location.href='index.php';</script>";
    }
