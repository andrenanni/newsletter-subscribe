<?php
    session_start();
    class Pessoa{
        public $nome;
        public $email;

        public function __construct($nome, $email) {
            $this->nome = htmlspecialchars($nome);
            $this->email = htmlspecialchars($email);
        }
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nome = $_POST["nome"] ?? "";
        $email = $_POST["email"] ?? "";

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        if(empty($nome) || empty($email)){
            $_SESSION['erro'] =  "Por favor, preencha todos os campos.";
        }
        else{
            $pessoa = New Pessoa($nome, $email);
            $_SESSION["mensagem"] = true;
        }
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter - Subscribe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="box-subscribe">
            <?php if (!isset($_SESSION["mensagem"])): ?>
                <div class="content-left">
                    <div class="img-container">
                        <img class="img-subscribe" src="/assets/asset_1.svg" alt="" srcset="">
                    </div>
                </div>
                <div class="content-right">
                    <div>
                        <h2>Subscribe to our<br>Newsletter!</h2>
                        <p>Subscribe to our newsletter and stay<br>updated.</p>
                    </div>
                    <form method="post">
                        <div class="input">
                            <input type="text" name="nome" id="" placeholder="Nome" require >
                            <input type="email" name="email" id="" placeholder="E-mail" require>
                        </div>

                        <?php if(!empty($_SESSION['erro'])): ?>
                            <p><?= $_SESSION['erro'] ?></p>
                            <?php unset($_SESSION['erro']); ?>
                        <?php endif; ?>

                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            <?php endif; ?>
        
            <?php if (isset($_SESSION["mensagem"]) && $_SESSION["mensagem"] === true) : ?>
                <div class="back-message">
                    <div class="content-center">
                        <p> <?= $_SESSION['nome'] ?> <br>Thanks for joining our newsletter.<br>We’ll keep you updated with the latest news and tips.</p>
                        <div class="image-container">
                            <img class="img-thanks" src="/assets/asset_2.svg" alt="" srcset="">
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION["mensagem"]); ?>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>