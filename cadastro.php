<?php
    include("../atv_dashboard/dashboard-senalivre/header.php");
    include("../atv_dashboard/conexao.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!empty($_POST["cpf"])) {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $cpf = $_POST["cpf"];
            $senha = $_POST["senha"];
    
            $sql ="INSERT INTO usuarios (nome, email, cpf, senha) VALUES (:nome, :email, :cpf, :senha) ";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":cpf", $cpf);
            $stmt->bindValue(":senha", $senha);
            $stmt->execute();
    
            if($stmt->rowCount() > 0){
                echo"<div class='sucess'>usuario cadastrado com sucesso</div>";
            }else{
                echo"<div class='error'> falha ao registrar o usuario</div>";
            }

        } else {

            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $sql = "SELECT * FROM usuarios WHERE email = :email and senha = :senha";
            $stmt = $conexao->prepare($sql);
        
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":senha", $senha);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result){
               header("Location: telalistagem.php");
            }
            else {
                echo"<div class = 'error'>falha em logar o usuário</div>";
            }
        }

       
    }
?>
<style>
    body {
        display: block;
    }
</style>

<nav id="cad-nav">
                <a href="../atv_dashboard/dashboard-senalivre/index.php">Voltar</a>
</nav>

<div id="reg" >
        <div class="signup">
            <form class="imp" method="POST">
                <label for="chk" aria-hidden="true">Cadastre-se</label>
                <input type="text" name="nome" id="nome" placeholder="Nome" required="">
                <input type="number" name="cpf" id="cpf" placeholder="CPF" required="">
                <input type="email" name="email" id="email" placeholder="Email" required="">
                <input type="password" name="senha" id="senha" placeholder="Senha" required="">
                <button class="cads">Sign up</button>
            </form>
    </div>

    <div class="login">
        <div class="">
            <form class="imp" method="POST">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="senha" placeholder="Senha" required="">
                <button class="cads">Login</button>
                </form>
        </div>
    </div>
</div>

<?php
    include("../atv_dashboard/dashboard-senalivre/footer.php")
?>