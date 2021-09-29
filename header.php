<?php
  session_start();
?>
<style>
<?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
      <nav class="nav-header-main">
        <ul class="nav-list">
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About us</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <div class="header-login-right-nav">
          
          <?php
         if (isset($_SESSION['userId'])) {
           echo '<form action="includes/logout.inc.php" method="post">
           <button type="submit" name="logout-submit">Logout</button>
           </form>';
          }
          else {
            echo '<form action="includes/login.inc.php" method="post">
            <input type="text" name="userUsernameemail" placeholder="E-mail/Username">
            <input type="password" name="userPassword" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
            <a href="signup.php" class="header-signup">Signup</a>
            </form>';
          }
          ?>
        
        
      </div>
    </nav>
    </header>
  
</body>
</html>


            