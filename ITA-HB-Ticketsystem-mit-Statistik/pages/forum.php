
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<head>
    <title>Maurer | Forum</title>
    <meta name="viewport" content="width=devide-width, intital-scale=1.0">
    <meta http-equiv="content-type" content="text/plain; charset=utf-8" />
    <meta http-equiv="content-language" content="de" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="../forumstyle.css" />
</head>

<body>
    <div id="login-section">
    <a href="../"><img src="../pictures/chris-industriesscaled.png" class="img"/></a>
        <div class="login-container">
            <h1>LOGIN</h1>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="myForm" id="myForm">
                <div class="input-container">
                    <input type="text" name="username" required="" />
                    <label>Username</label>
                </div>

                <div class="input-container">
                    <input type="text" name="email" required="" />
                    <label>Email</label>
                </div>

                <input type="submit" name="senden" value="submit" class="btn"/>
            </form>
            
            <!-- 
                TODO:
                
                Fix <textarea> at "Eintrag hinzufügen"
                add errors in class="error"
                Make class="input-container" responsive
            -->
            
        </div>

        <?php
                if(isset($_POST['senden']))
                { 
                    include '../lib/form_validation.php';

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

                    foreach($fehler_nachricht as $fehler)
                    {
                        echo '<div id="error-box">';
                        echo  "<p>" . $fehler . "</p>";
                        echo "</div><br><br>";
                    }

                    if($success == 1)
                    {
                        $logged = false;

                        $s = fopen("../data/ticketsystem/ticketlog.csv", "r");
                        while(!feof($s))
                        {
                            $row = fgets($s, 4096);
                            $column = explode("\t", $row);
                            $failure = true;

                            if(strpos($row, $username) != NULL)
                            {
                                if(strpos($row, $email) != NULL)
                                {
                                    $logged = true;
                                    $failure = false;
                                    break;
                                }
                            }
                        }
                        fclose($s);

                        if($failure == true)
                        {
                            echo '<div id="error-box"><b>Fehler!</b> Prüfen Sie die Daten oder <a href="Ticketsystem.php">erstellen sie ein Ticket HIER</a></div>';
                        }

                        if($logged == true)
                        {
                            echo '<center><div class="success-box">';
                            echo 'ERFOLG!<br> Drücken Sie  <b><a href="#eintrag">HIER</a></b> für das Schreiben';
                            echo '</center></div></div>';

                            $f = fopen("../data/forum-data/login-time.csv", "a+");
                            $c = new SplFileObject("../data/forum-data/login-time.csv", "r");
                            $c->seek(PHP_INT_MAX);
                            $counter = $c->key() + 1;
    
                            $date = date("d.m.Y");
                            $time = date("H:i");
    
                            $login_data = array($counter, $username, $email, $date, $time);
                            fputcsv($f, $login_data, ";");
    
                            fclose($f);

                            $e = fopen("../data/temp/tempuser.txt", "w");
                            fwrite($e, $username . "\t" . $email);
                            fclose($e);

                            echo '<section id="eintrag"><div id="forum-section"><div class="thread-add">
                            <h1>Eintrag erstellen</h1>
                            <div class="thread-add-submit">
                            <form method="post" action="forum.php" name="form" id="form">
                                <textarea name="eintrag" class="thread-add" placeholder="HIER EINTIPPEN..."></textarea>
                                <input type="submit" value="hochladen" name="thread" class="btn">
                            </form>
                            </div></div></section>';
                        }
                    }
                }

                if(isset($_POST['thread']))
                {
                    $eintrag = htmlspecialchars($_POST['eintrag']);
                    $date = date('d.m.Y');

                    $e = fopen("../data/temp/tempuser.txt", "r");

                    $textline = fread($e, 4096);
                    $user = substr($textline, 0, strpos($textline, "\t"));
                    $mail = substr($textline, strpos($textline, "\t"));

                    fclose($e);
                    $f = fopen("../data/forum-data/threads.csv", "a");
                    $data = array($user, str_replace("\r\n", "<br />", $eintrag), $date, time(), $mail);
                    fputcsv($f, $data, ";", chr(127));
                    fclose($f);
                    echo '<center><div class="success-box">';
                    echo 'ERFOLG!';
                    echo '</center></div>';
                    //echo "Username: " . $user . "<br>" . "Email: " . $mail; 
                }
            ?>
</div>
<?php
$t = fopen("../data/forum-data/threads.csv", "r");
$today = time();
while(!feof($t))
{
    $row = fgets($t, 4096);
    $column = explode(";", $row);
    $thread_timestamp_info = "";

    if(sizeof($column) == 5)
    {
        //$days = floor(($today / 60 / 60 / 24) - ($column[3] / 60 / 60 / 24));
        $hours = floor(($today / 60 / 60) - ($column[3] / 60 / 60));
        $minutes = floor(($today / 60) - ($column[3] / 60));
        //echo $days . "<br>";
        //echo $hours . "<br>";
        //echo $minutes . "<br>";
        if($hours == 0 && $minutes == 0)
        {
            $thread_timestamp_info = " ~ vor ein paar Sekunden";
        }
    
        elseif($hours == 0)
        {
            $thread_timestamp_info = " ~ vor " . $minutes . " Minuten";
            if($minutes == 1)
            {
                $thread_timestamp_info = " ~ vor eine Minute";
            }
        }

        elseif($hours > 0 && $hours < 24)
        {
            $thread_timestamp_info = " ~ vor " . $hours . " Stunden";
            if($hours == 1)
            {
                $thread_timestamp_info = " ~ vor eine Stunde";
            }
        }
    
        echo '<div id="forum-section">
        <div class="thread-box">
            <img src="../pictures/profile.jpg" alt="profile" class="user-picture">
            <div class="user">'.
                $column[0] . '
            </div>
    
            <div class="thread-timestamp">' .
                 $thread_timestamp_info . '<br><br>
            </div>
    
            <div class="thread-date">'.
                $column[2].'
            </div>
            <div class="thread">'.
                $column[1] . '
            </div>
        </div>
    </div>';
    }
}
fclose($t);
?>

</html>