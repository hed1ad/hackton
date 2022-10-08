<?php
    require "db.php";

    $data = $_POST;
    if ( isset($data['do_login']))
    {
        $errors = array();
        // Ищем юзера
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if ( $user )
        {
            // Логин существует
          if ( password_verify($data['password'], $user->password))
          {
           // Все хорошо, логиним пользователя
           $_SESSION['logged_user'] = $user;
           echo '<div style="color: green;">Вы авторизованы</div><hr>'; 
          }else
          {
            $errors[] = 'Пароль введен не верно';
          }
        } else
        {
            $errors[] = 'Пользователь не найден';
        }

        if( ! empty($errors))
        {
          echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        } 
    

    }
?>

<form action="login.php" method="POST">

  <p>
    <p><strong>Логин</strong>:</p>
    <input type="text" name="login" >
  </p>

  <p>
    <p><strong>Ваш пароль</strong>:</p>
    <input type="password" name="password" >
  </p>

  <p>
    <button type="submit" name="do_login">Войти</button>
  </p>


 
</form>