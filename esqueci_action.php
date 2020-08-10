<?php
session_start();
require './classes/Usuario.php';
require './classes/UsuarioToken.php';
require __DIR__.'/classes/Email.php';
require './config.php';


use PHPMailer\PHPMailer\PHPMailer;
echo "<pre>";


date_default_timezone_set("America/Sao_Paulo");
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
/*
* é verificado se o email foi enviado e se ele existe no banco de dados na tabela usuarios utilizando a função selectArray($email)
* se retornar true quer dizer que existe, portanto utilizando destes dados é criado uma variável $id com o id da pessoa da tabela usuarios  para ser
* inserido na tabela usuario_token, além de $token e $data.
*/

if($email) {
    $user = new Usuario($pdo);
    $select = $user->selectArray($email);
    if($select) {
        $id = $select['id'];
        $token = md5(time().rand(0,9999).rand(0,9999));
        $data = date('Y-m-d H:i', strtotime('+2 hours'));
        $userToken = new UsuarioToken($pdo);
        $userToken->adicionarUsuarioToken($id, $token, $data);
        $buscaToken = $userToken->buscaToken($id);
        
        if($userToken->selectArrayToken($token)) {
            $link = '<a href="http://localhost/login_redecom_2/verifica_token.php?token='.$buscaToken.'">link</a>';
    
            $mensagem =  "Clique no link para redefinir sua senha:<br>".$link;
    
            $titulo = "Redefinição de senha";
    
            $headers = "From: weslley.leite@mesquita.rj.gov.br"."\r\n".
                        "Reply-To: ".$email."\r\n".
                        "X-Mailer: PHP/".phpversion();
    
            /*mail($email, $assunto, $mensagem, $headers);
            echo $mensagem."<br>";
            echo $buscaToken;
            echo 'teste';*/


            //var_dump($mail1);
            $mensagem = '<h1>Redefinição de Senha</h1>
                        <p>Clique no Link abaixo para redefinir sua senha</p>
                        <a href="http://localhost/login_redecom_2/verifica_token.php?token='.$buscaToken.'">Clique Aqui!</a>';

            $mail1 = new Email('governodemesquita@gmail.com', $email, $mensagem, $titulo);
           
            var_dump($mail1);


        } else{

            $link = '<a href="http://localhost/login_redecom_2/verifica_token.php?token='.$buscaToken.'">link</a>';
    
            $mensagem =  "Clique no link para redefinir sua senha:<br>".$link;
    
            $titulo = "Redefinição de senha";
    
            $headers = "From: weslley.leite@mesquita.rj.gov.br"."\r\n".
                        "Reply-To: ".$email."\r\n".
                        "X-Mailer: PHP/".phpversion();
            
            //$email = mail($email, $assunto, $mensagem, $headers);
            /*if($email) {
                header("Location:index.php");
                //msg sucesso
            } else {
                header("Location: index.php");
                //msg erro
            }*/
            /*$newDate = date("Y-m-d H:i", strtotime('+2 hours' ));
            echo $newDate;
            echo $mensagem."<br>";
            echo $buscaToken;*/
            $mensagem = '<h1>Redefinição de Senha</h1>
                        <p>Clique no Link abaixo para redefinir sua senha</p>
                        <a href="http://localhost/login_redecom_2/verifica_token.php?token='.$buscaToken.'">Clique Aqui!</a>';

            $mail2 = new Email('governodemesquita@gmail.com', $email, $mensagem, $titulo);
            //echo $mensagem;
            var_dump($mail2);
            
        }

    } else {
        header("Location: esqueci.html");
        exit;
    }
}

?>
