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
    <div id="background">
        <div class="login-container">
            <h1>LOGIN</h1>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="myForm" id="myForm">
                <div class="input-container">
                    <input type="text" name="vorgangsnummer" required="" />
                    <label>Full Name</label>
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
                if(isset($_POST['senden']))
                { 
                    require __DIR__ . '/functions/form_validation.php';

                    $vorgangsnummer = strtoupper($_POST['vorgangsnummer']);
                    $email = strtolower($_POST['email']);

                    $vorgangsnummer = trim($vorgangsnummer, " ");
                    $email = trim($email, " ");
                    
                    $success = 1;
                
                    $fehler_nachricht = array();
                
                    if(field_empty($vorgangsnummer, "Vorgangsnummer", $fehler_nachricht) == 0)
                        $success = 0;

                    if(field_email($email, $fehler_nachricht) == 0)
                        $success = 0;

                    if($success == 1)
                    {
                        echo '<center><div class="success-box">';
                        echo 'ERFOLG!<br> Drücken Sie  <b><a href="#top3">HIER</a></b> um Forum zu sehen.';
                        echo '</center></div>';
                    }
                
                    foreach($fehler_nachricht as $fehler)
                    {
                        echo '<div id="error-box">';
                        echo  "<p>" . $fehler . "</p>";
                        echo "</div><br><br>";
                    }
                }
            ?>
    </div>


    <div class="ranking-container">
        <h1>UNSERE TOP 3 EINTRÄGE</h1>
        <section id="top3">
        <table border="0" cellspacing="40">
            <tr>
                <td>Rank 1</td>
                <td>Rank 2</td>
                <td>Rank 3</td>
            </tr>
        </table>
        </section>
    </div>

    <div id="footer">
        hallo
    </div>
</body>

</html>