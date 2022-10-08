<?php
  require "db.php"
?>  


<?php if( isset($_SESSION['logged_user'])) : ?>
  Авторизован!<br>
  Здравствуйте!, <?php echo $_SESSION['logged_user']->fullname; ?>
  <hr>
  <a href="/logout.php">Выйти</a>
<?php else : ?> 
  <a href="/login.php">Авторизироваться</a><br>
  <a href="/signup.php">Регистарция</a>
<?php endif; ?>