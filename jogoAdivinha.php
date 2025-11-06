<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    echo "
        <p>Adivinhe o Número que eu estou pensando entre 1 e 100.</p>
        <form action='#' method='post'>
            <input type='text' name='entrada'>
            <input type='submit' value='Tentar'>
        </form><br/>
    ";

    if (!isset($_SESSION['numero'])) {
        $_SESSION['numero'] = rand(1, 100);
        $_SESSION['tentativas'] = 0;
        $_SESSION['lista_numeros'] = [];
    }

    if(isset($_POST['entrada']) && $_POST['entrada'] !== 's') {
        $entrada = intval($_POST['entrada']);
        $output = "";
        

        if ($_SESSION['numero'] == $entrada){
            echo "Parabéns! Você adivinhou o número {$_SESSION['numero']} em {$_SESSION['tentativas']} tentativas.<br/>";
            session_destroy();
        } elseif($_SESSION['numero'] > $entrada){
            echo "O número é maior que $entrada.<br/>";
        } else {
            echo "O número é menor que $entrada.<br/>";
        }

        $_SESSION['tentativas']++;
        $_SESSION['lista_numeros'][] = $entrada;
        foreach($_SESSION['lista_numeros'] as $valor) {
            $output .= $valor .  " ";
        }

        echo "Número de tentativas:  <strong>" . $_SESSION['tentativas'] . "</strong> <br/>"; 
        echo "Os valores testados: <strong> $output </strong>";
    } else if (isset($_POST['entrada']) && $_POST['entrada'] === 's') {
        unset($_SESSION['numero']);
        
        session_destroy();
    }

    ?>
</body>
</html>