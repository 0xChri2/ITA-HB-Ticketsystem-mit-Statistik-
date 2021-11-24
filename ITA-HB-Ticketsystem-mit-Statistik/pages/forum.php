<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<head>
    <title>Maurer | Forum</title>
    <meta name="viewport" content="width=devide-width, intital-scale=1.0">
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
          $username_valid = "";
          $email_valid = "";
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
                        echo 'ERFOLG!<br> Drücken Sie  <b><a href="#threads">HIER</a></b> um Threads zu lesen';
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

                        $username_valid = $username;
                        $email_valid = $email;
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

    <div id="forum-section">
    <?php
        $lol = false;
        if($show_forum == true)
        {
            echo '<div class="thread-add">
                <h1>Eintrag erstellen</h1>
                <div class="thread-add-submit">
                <form method="post" action="forum.php" name="form" id="form">
                    <textarea name="eintrag" placeholder="HIER EINTIPPEN..."></textarea>
                    <input type="submit" value="hochladen" name="thread" class="btn">
                </form></div></div>';

            if(isset($_POST['thread']))
            {
                $eintrag = htmlspecialchars($_POST['eintrag']);
                $f = fopen("../data/forum-data/threads.csv", "a");
                $data = array($username_valid, $email_valid, $eintrag);
                fputcsv($f, $data);
                fclose($f);
                echo '<center><div class="success-box">';
                echo 'ERFOLG!';
                echo '</center></div>';
                $lol = true;
            }
        }
    ?>

    <?php 
        if($lol == true)
        {
            echo "NICE";
        } 
        else
            echo "fuck";
    ?>

<!-- ToDo: On login, show class="thread-add", umfrage.php -->

        <div class="thread-box">
            <div class="user">
                Darko Pizdun<br>
            </div>
            <div class="thread-date">
                10.11.2021<br>
            </div>
            <div class="thread">
            Anstatt ein Programm mit vielen Anweisungen zur Ausgabe von HTML zu schreiben, schreibt man etwas HTML und bettet einige Anweisungen ein, die irgendetwas tun (wie hier "Hallo, ich bin ein PHP-Skript!" auszugeben). Der PHP-Code steht zwischen speziellen Anfangs- und Abschluss-Verarbeitungsinstruktionen, mit denen man in den "PHP-Modus" und zurück wechseln kann.

PHP unterscheidet sich von clientseitigen Sprachen wie Javascript dadurch, dass der Code auf dem Server ausgeführt wird und dort HTML-Ausgaben generiert, die an den Client gesendet werden. Der Client erhält also nur das Ergebnis der Skriptausführung, ohne dass es möglich ist herauszufinden, wie der eigentliche Code aussieht. Sie können Ihren Webserver auch anweisen, alle Ihre HTML-Dateien mit PHP zu parsen, denn dann gibt es wirklich nichts, das dem Benutzer sagt, was Sie in petto haben.
            </div>
            <button>Antworten</button>
        </div>

        <div class="thread-box">
            <div class="user">
                Max Mustermann<br>
            </div>
            <div class="thread-date">
                10.11.2021<br>
            </div>
            <div class="thread">
            Anstatt ein Programm mit vielen Anweisungen zur Ausgabe von HTML zu schreiben, schreibt man etwas HTML und bettet einige Anweisungen ein, die irgendetwas tun (wie hier "Hallo, ich bin ein PHP-Skript!" auszugeben). Der PHP-Code steht zwischen speziellen Anfangs- und Abschluss-Verarbeitungsinstruktionen, mit denen man in den "PHP-Modus" und zurück wechseln kann.

PHP unterscheidet sich von clientseitigen Sprachen wie Javascript dadurch, dass der Code auf dem Server ausgeführt wird und dort HTML-Ausgaben generiert, die an den Client gesendet werden. Der Client erhält also nur das Ergebnis der Skriptausführung, ohne dass es möglich ist herauszufinden, wie der eigentliche Code aussieht. Sie können Ihren Webserver auch anweisen, alle Ihre HTML-Dateien mit PHP zu parsen, denn dann gibt es wirklich nichts, das dem Benutzer sagt, was Sie in petto haben.
            </div>
            <button>Antworten</button>
        </div>

        <div class="thread-box">
            <div class="user">
                Babura Zlivaca<br>
            </div>
            <div class="thread-date">
                10.11.2021<br>
            </div>
            <div class="thread">
            Anstatt ein Programm mit vielen Anweisungen zur Ausgabe von HTML zu schreiben, schreibt man etwas HTML und bettet einige Anweisungen ein, die irgendetwas tun (wie hier "Hallo, ich bin ein PHP-Skript!" auszugeben). Der PHP-Code steht zwischen speziellen Anfangs- und Abschluss-Verarbeitungsinstruktionen, mit denen man in den "PHP-Modus" und zurück wechseln kann.

PHP unterscheidet sich von clientseitigen Sprachen wie Javascript dadurch, dass der Code auf dem Server ausgeführt wird und dort HTML-Ausgaben generiert, die an den Client gesendet werden. Der Client erhält also nur das Ergebnis der Skriptausführung, ohne dass es möglich ist herauszufinden, wie der eigentliche Code aussieht. Sie können Ihren Webserver auch anweisen, alle Ihre HTML-Dateien mit PHP zu parsen, denn dann gibt es wirklich nichts, das dem Benutzer sagt, was Sie in petto haben.
            </div>
            <button>Antworten</button>
        </div>
    </div>

    <div id="footer">
        hallo
    </div>
</body>

</html>