<?php
// Inicia sessão apenas se ainda não existir
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('includes/ligacao.php');

// Processa login
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta utilizador
    $sql = "SELECT * FROM utilizadores WHERE email='$email'";
    $res = $conn->query($sql);
  

    if(!$res){
        die("Erro na query: ".$conn->error);
    }

    if($res->num_rows == 1){
        $user = $res->fetch_assoc();
        if(password_verify($senha, $user['senha'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_tipo'] = $user['tipo'];
            // Redireciona conforme tipo
            header('Location: '.($user['tipo']=='admin'?'admin/index.php':'index.php'));
            exit;
        } else {
            $error = 'Senha incorreta';
        }
    } else {
        $error = 'Email não encontrado';
    }
}
?>

<?php include 'includes/menu.php'; ?>


<h2 class="inner-page-hero">Login</h2>
<div class="login-container">
    <form method="post" id="login-form">
        Email: <input type="email" name="email" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" value="Login" class="btn">
    </form>
</div>

<?php 

// Exibe mensagem de erro se existir
if(isset($error)){
    echo "<p style='color:red;'>$error</p>";
}
?>

