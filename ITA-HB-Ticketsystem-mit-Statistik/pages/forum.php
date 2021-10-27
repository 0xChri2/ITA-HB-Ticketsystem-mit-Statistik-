<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<head>
    <title>Maurer | Forum</title>
    <meta http-equiv="content-type" content="text/plain; charset=utf-8" />
    <meta http-equiv="content-language" content="de" />
    <link type="text/css" rel="stylesheet" href="../forumstyle.css" />
</head>
<!-- dakro-->

<body>
    <div id="login-section">
        <div class="login-container">
            <h1>LOGIN</h1>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="myForm" id="myForm">
                <div class="input-container">
                    <input type="text" name="username" required="" />
                    <label>Username</label>
                </div>

                <div class="input-container">
                    <input type="mail" name="email" required="" />
                    <label>Email</label>
                </div>

                <input type="submit" name="senden" value="submit" class="btn"/>
            </form>

            <!-- 
                TODO:

                Add picture transition
                Make class="input-container" responsive
            -->

        </div>

        <?php
          $show_forum = false;
                if(isset($_POST['senden']))
                { 
                    require __DIR__ . '/../functions/form_validation.php';

                    $username = $_POST['username'];
                    $email = strtolower($_POST['email']);

                    $username = trim($username, " ");
                    $email = trim($email, " ");
                    
                    $success = 1;
                
                    $fehler_nachricht = array();
                
                    if(field_empty($username, "username", $fehler_nachricht) == 0)
                        $success = 0;

                    if(field_email($email, $fehler_nachricht) == 0)
                        $success = 0;

                    if($success == 1)
                    {
                      $show_forum = true;
                        echo '<center><div class="success-box">';
                        echo 'ERFOLG!<br> Drücken Sie  <b><a href="#rating">HIER</a></b> um uns zu bewerten.';
                        echo '</center></div>';

                        $f = fopen("../data/forum-data/login-time.csv", "a+");
                        $c = new SplFileObject("../data/forum-data/login-time.csv", "r");
                        $c->seek(PHP_INT_MAX);
                        $counter = $c->key() + 1;

                        $date = date("d.m.y");
                        $time = date("H:i");

                        $login_data = array($counter, $username, $email, $date, $time);
                        fputcsv($f, $login_data, ";");

                        fclose($f);
                    }
                
                    foreach($fehler_nachricht as $fehler)
                    {
                        echo '<div id="error-box">';
                        echo  "<p>" . $fehler . "</p>";
                        echo "</div><br><br>";
                    }
                }

                if(isset($_POST['send']))
                {
                    $t = fopen("/../data/forum-data/threads.csv", "a+");
                    $c = new SplFileObject("../data/forum-data/threads.csv", "r");
          
                    $c->seek(PHP_INT_MAX);
                    $counter = $c->key() + 1;
          
                    $rate_data = array($_POST['rating'], $_POST['comment']);
                    fputcsv($t, $rate_data, ";");
          
                    fclose($t);
                    echo '<center><div class="success-box">';
                    echo 'ABGESENDET!<br> Drücken Sie  <b><a href="#top3">HIER</a></b> um weitere Threads zu lesen';
                    echo '</center></div>';
                }
            ?>
    </div>

    <?php
      if($show_forum == true)
      {
        echo "was geht";
      }
    ?>

    <div id="footer">
        hallo
    </div>
</body>

</html>