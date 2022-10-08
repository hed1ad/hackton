<?php
  require "db.php"; 

  $data = $_POST;
  if( isset($data['do_signup']) )
  {
    // Здесь регистрируем

    // Проверка на пустоту
    $errors = array(); 
    if ( trim($data['login']) == '' )
    {
      $errors[] = 'Введите логин!';
    }

    if ( trim($data['fullname']) == '' )
    {
      $errors[] = 'Введите свое полное имя!';
    }

    if ( $data['password'] == '' )
    {
      $errors[] = 'Введите пароль!';
    }

    if ( $data['password_2']!= $data['password'])
    {
      $errors[] = 'Пароли не совпадают!';  
    }
    // Проверка одинаковых логинов
    if (R::count('users',"login = ?", array($data['login']))> 0)
    {
      $errors[] = 'Логин уже занят';  
    }
    if (R::count('users',"fullname = ?", array($data['fullname']))> 0)
    {
      $errors[] = 'Вы уже зарегистрированы';  
    }

    if( empty($errors))
    {
      // Все хорошо, регистрируем
      $user = R::dispense('users');
      $user->login = $data['login'];
      $user->fullname= $data['fullname'];
      $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
      R::store($user); 
      echo '<div style="color: green;">Вы успешно зарегистрированы</div><hr>';
    } else 
    {
      echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }

  }

?>  


<form action="/signup.php" method="POST">
  

  <p>
    <p><strong>Полное имя</strong>:</p>
    <input type="text" name="fullname" >
  </p>
  <p>
    <p><strong>Ваш логин</strong>:</p>
    <input type="text" name="login" >
  </p>

  <p>
    <p><strong>Ваш пароль</strong>:</p>
    <input type="password" name="password" >
  </p>

  <p>
    <p><strong>Введите ваш пароль еще раз</strong>:</p>
    <input type="password" name="password_2" >
  </p>

  <p>
    <button type="submit" name="do_signup">Зарегистрироваться</button>
  </p>

</form>

