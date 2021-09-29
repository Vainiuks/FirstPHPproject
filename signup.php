<?php
    require "header.php";
?>


    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <h1 class="signup-h1">Signup</h1>
                <?php
          
                    //Handling error and show them on screen not in url
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="signup-error">Fill in all fields!</p>';
                        }
                         else if ($_GET['error'] == "invalidusernameandemail") {
                            echo '<p class="signup-error">Invalid username and e-mail!</p>';
                        }
                         else if ($_GET['error'] == "invalidEmail") {
                            echo '<p class="signup-error">Invalid e-mail!</p>';
                        }
                         else if ($_GET['error'] == "invalidUsername") {
                            echo '<p class="signup-error">Invalid username!</p>';
                        }
                         else if ($_GET['error'] == "passwordcheck") {
                            echo '<p class="signup-error">Passwords do not match!</p>';
                        }
                         else if ($_GET['error'] == "usertaken") {
                            echo '<p class="signup-error">Username is already taken!</p>';
                        }
                        else if ($_GET['error'] == "emailtaken") {
                            echo '<p class="signup-error">E-mail is already taken!</p>';
                        }
                    }
                    else if (isset($_GET['signup'])) {
                        if($_GET['signup'] == "success") {
                            echo '<p class="signup-success">You were signed up successfully!</p>';
                        }
                        else {
                            
                        }
                    }
                  
                ?>
                
                <form class="form-signup" action="includes/signup.inc.php" method="post">
                    <?php
                    //Get username or email from url if there was something wrong during sign up proccess and leave them in textbox if they were correct 
                        if (isset($_GET['userUsername'])) {
                            $username = $_GET['userUsername'];
                            echo '<input type="text" name="userUsername" placeholder="Username" value="'.$username.'">';
                        } 
                        else {
                            echo '<input type="text" name="userUsername" placeholder="Username">';
                        }
                        if (isset($_GET['userEmail'])) {
                            $email = $_GET['userEmail'];
                            echo '<input type="text" name="userEmail" placeholder="E-mail" value="'.$email.'">';
                        } 
                        else {
                            echo '<input type="text" name="userEmail" placeholder="E-mail">';
                        }
                    ?>
                    
                    <input type="password" name="userPassword" placeholder="Password">
                    <input type="password" name="userPassword-repeat" placeholder="Repeat password">
                    <button class="signup-button" type="submit" name="signup-submit">Signup</button>
                </form>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>