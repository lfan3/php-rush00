<?php

session_start();

$file1 = "admin";
$file2 = "users";
//check if the person is admin
function admin_auth($login, $password){
    $admin_accounts = file_get_contents('admin.json');
    $admin_accounts = json_decode($admin_accounts);
    foreach($admin_accounts as $acc){
        if($acc->login === $_POST['login'] && $acc->password === hash('whirlpool', $_POST['password'])){
            return TRUE;
        }
    }
    return FALSE;
}
//check if the person hat normal user account
function user_auth($login, $password){
    $user_accounts = file_get_contents('user.json');
    $user_accounts = json_decode($user_accounts);
    foreach($user_accounts as $user){
        if($user->login === $_POST['login'] && $user->password === hash('whirlpool', $_POST['password'])){
            return TRUE;
        }
    }
    return FALSE;
}

if(!empty($_POST['login'] && !empty($_POST['password']) && $_POST['submit'] === 'OK')){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $admin_auth = admin_auth($login, $password);
    $user_auth = user_auth($login, $password);
    if($admin_auth){
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['logged_in'] = true;
        $_SESSION['droit'] = 1;
    }
    else if($user_auth){
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['logged_in'] = true;
        $_SESSION['droit'] = 2;
    }
    else{
        echo "<p> forgot your login or password? </p>";
        echo "<p> if you are new here, plese make incription </p>";
    }              
}  


echo "<h1> welcome ".$_SESSION['login']." </h1>";
if (! empty($_SESSION['logged_in']))
{
?>

    <p>here is my super-secret content</p>
    <a href='logout.php'>Click here to log out</a>

<?php
}
else
{
    echo 'You are not logged in. <a href="login.php">Click here</a> to log in.';
}

?>


