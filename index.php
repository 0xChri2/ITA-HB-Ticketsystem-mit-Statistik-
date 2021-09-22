<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Impfstatus</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="shortcut icon" type="image/jpg" href="Bilder/logo.ico"/>
    </head>

    <body>
        <?php
            $vorname = "";
            $nachname = "";
            $anrede = "";
            $email = "";
            $tag = "";
            $monat = "";
            $jahr = "";
            $impfstatus = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                if (isset($_POST['Vorname']))
                { //change name content only if the post value is set!
                    $vorname = filter_input (INPUT_POST, 'Vorname', FILTER_SANITIZE_STRING); //filter value
                }

                if (isset($_POST['Nachname']))
                { //change name content only if the post value is set!
                    $nachname = filter_input (INPUT_POST, 'Nachname', FILTER_SANITIZE_STRING); //filter value
                }

                if (isset($_POST['Email']))
                { //change name content only if the post value is set!
                    $email = filter_input (INPUT_POST, 'Email', FILTER_SANITIZE_STRING); //filter value
                }

                if (isset($_POST['Tag']))
                { //change name content only if the post value is set!
                    $tag = filter_input (INPUT_POST, 'Tag', FILTER_SANITIZE_STRING); //filter value
                }

                if (isset($_POST['Monat']))
                { //change name content only if the post value is set!
                    $monat = filter_input (INPUT_POST, 'Monat', FILTER_SANITIZE_STRING); //filter value
                }

                if (isset($_POST['Jahr']))
                { //change name content only if the post value is set!
                    $jahr = filter_input (INPUT_POST, 'Jahr', FILTER_SANITIZE_STRING); //filter value
                }

                if (isset($_POST['Impfstatus']))
                { //change name content only if the post value is set!
                    $impfstatus = filter_input (INPUT_POST, 'Impfstatus', FILTER_SANITIZE_STRING); //filter value
                }
            }
        ?>
        <div id="background">
            <div id="intro6">
                <div id="intro6background">
                    <p id="intro6font">Impfstatus</p>
                    <hr id="hrpic"><br>
                    <p id="intro6font1">Bitte die Felder ausfüllen</p>
                </div>

                <div id="intro6inhalt">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="myForm" id="idForm">
                        <p id="intro6left">Vorname*</p>
                        <p id="intro6right">Nachname*</p><br><br><br>
                        <input size="20" type="text" name="Vorname" value="<?php  echo $vorname;?>" required>
                        <input size="20" type="text" name="Nachname" value="<?php  echo $nachname;?>" required><br><br>

                        Mann*
                        <input type="radio" value="Herr" name="Anrede" required>
                        <div id="intro6right">
                        <input type="radio" value="Frau" name="Anrede" required>
                        Frau*
                        </div>
                        <br><br>

                        <hr id="hrinhalt"><br>

                        <p id="intro6left">Email*</p>
                        <p id="intro6right">Geimpft?*</p><br><br><br>
                        <input size="20" type="text" name="Email" value="<?php  echo $email;?>" required>
                        <select name="Impfstatus" value="<?php  echo $impfstatus;?>" required>
                            <option>NICHT Geimpft </option>
                            <option>Geimpft</option>
                        </select>
                        <br><br>

                        <hr id="hrinhalt"><br>

                        <p>Geburt*</p><br>
                        <input size="20" type="text" placeholder="Tag" name="Tag" value="<?php  echo $tag;?>" required><br><br>
                        <input size="20" type="text" placeholder="Monat" name="Monat" value="<?php  echo $monat;?>" required><br><br>
                        <input size="20" type="text" placeholder="Jahr" name="Jahr" value="<?php  echo $jahr;?>" required><br><br>

                        <br><hr id="hrinhalt"><br>

                        <input type="submit" name="Senden" value="Senden">
                        <input type="reset" value="Reset">
                        <br><br>

                    </form>

        <?php
            if(isset($_POST['Senden']))
            {
                $vorname = ucfirst($_POST['Vorname']);
                $nachname = ucfirst($_POST['Nachname']);
                $anrede = $_POST['Anrede'];
                $email = strtolower($_POST['Email']);
                $tag = $_POST['Tag'];
                $monat = $_POST['Monat'];
                $jahr = $_POST['Jahr'];
                $impfstatus = $_POST['Impfstatus'];
                
                $fehler_nachricht = array();
                $fehler_email = array();

                $success = 1;

                if (ctype_alpha($vorname)) 
                {
                    true;
                }

                else 
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Vorname' dürfen keine Zahlen verwendet werden";
                }

                if (ctype_alpha($nachname)) 
                {
                    true;
                }
                else 
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Nachname' dürfen keine Zahlen verwendet werden";
                }

                if($tag > 31)
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Tag' dürfen nur Zahlen(1,2,3...31) verwendet werden.";
                }

                if($tag < 1)
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Tag' dürfen nur Zahlen(1,2,3...31) verwendet werden.";
                }

                if($monat > 12 || $monat < 1)
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Monat' dürfen nur Zahlen(1,2,3...12) verwendet werden.";
                }

                if($jahr < 1900)
                {
                    $fehler_nachricht[] = "So alt bist du doch gar nicht!";
                    $success = 0;
                }

                if($jahr > 2021)
                {
                    $fehler_nachricht[] = "Im Feld 'Jahr' kann es nicht sein, dass Sie aus der Zukunft kommen.";
                    $success = 0;
                }

                if (strpos($email, '@') == NULL)
                {
                    $fehler_email[] = "In der Mail, '@' gibt es nicht.";
                    $success = 0;
                }

                $falchestelle = 0;

                if (strstr($email, '.') == NULL)
                {
                    $fehler_email[] = "In der Mail, '.' gibt es nicht.";
                    $success = 0;
                    $falchestelle = 1;
                }

                if($falchestelle == 0)
                {
                    if (strpos($_POST['Email'],".") == 0)
                    {
                        $fehler_nachricht[]= "In der Mail, '.' darf nicht an erster Stelle stehen!";
                        $success = 0;
                    }

                    $condition = 1;
                    $condition_1 = strlen(strchr($email, '@'));
                    $condition_2 = strlen(strchr($email, '.'));
    
                    //echo $condition_1 . "<br>";
                    //echo $condition_2 . "<br>";
                    $punkten = explode(".", $email);
    
                    if ($condition_1 < $condition_2 || strpos($email, '.') == NULL)
                    {
                        if ($punkten > 1)
                        {
                            if (strpos($email, '.') < strpos($email, '@') && 
                                strrpos($email, '.') > strpos($email, '@'))
                            {
                                $condition = 0;
                            }
                        }
    
                        if ($condition == 1)
                        {
                            $fehler_email[] = "In der Mail, '.' ist an der falsche Stelle.";
                            $success = 0;   
                        }
                    }
                }

                if (strlen($email) - 1 == strrpos($email, '.'))
                {
                    $fehler_email[] = "Nach einem '.' ist weiterer Inhalt erforderlich.";
                    $success = 0;
                }

                if (strlen($email) < 6)
                {
                    $fehler_email[] = "E-Mail darf mindestens 6 Zeichen sein.";
                    $success = 0;
                }

                if (strlen($email) > 320)
                {
                    $fehler_email[] = "E-Mail darf maximal 320 Zeichen sein.";
                    $success = 0;
                }

                if (strpos($email, ' ') != 0)
                {
                    $fehler_email[] = "E-Mail darf keine Leerzeichen haben.";
                    $success = 0;
                }

                //Ab hier bin ich schlau 
                $punkt = strpos($email, '@') + 1;
                if ($email[$punkt] == '.')
                {
                    $fehler_email[] = "Neben '@' darf kein '.' vorkommen"; 
                    $success = 0;
                }

                for ($i = 1; $i < strlen($email); $i++)
                {
                    if ($email[$i] != 'q' &&
                        $email[$i] != 'w' &&
                        $email[$i] != 'e' &&
                        $email[$i] != 'r' &&
                        $email[$i] != 't' &&
                        $email[$i] != 'z' &&
                        $email[$i] != 'u' &&
                        $email[$i] != 'i' &&
                        $email[$i] != 'o' &&
                        $email[$i] != 'p' &&
                        $email[$i] != 'a' &&
                        $email[$i] != 's' &&
                        $email[$i] != 'd' &&
                        $email[$i] != 'f' &&
                        $email[$i] != 'g' &&
                        $email[$i] != 'h' &&
                        $email[$i] != 'j' &&
                        $email[$i] != 'k' &&
                        $email[$i] != 'l' &&
                        $email[$i] != 'y' &&
                        $email[$i] != 'x' &&
                        $email[$i] != 'c' &&
                        $email[$i] != 'v' &&
                        $email[$i] != 'b' &&
                        $email[$i] != 'n' &&
                        $email[$i] != 'm' &&
                        $email[$i] != '.' &&
                        $email[$i] != '@' &&
                        $email[$i] != '0' &&
                        $email[$i] != '1' &&
                        $email[$i] != '2' &&
                        $email[$i] != '3' &&
                        $email[$i] != '4' &&
                        $email[$i] != '5' &&
                        $email[$i] != '6' &&
                        $email[$i] != '7' &&
                        $email[$i] != '8' &&
                        $email[$i] != '9')
                    {
                        $fehler_email[] = "E-Mail darf keine Sonderzeichen enthalten";
                        $success = 0;
                        break;
                    }
                }

                if(ctype_digit($tag))
                {
                    true;
                }
                else
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Tag' dürfen nur Zahlen(1,2,3...30) verwendet werden.";
                }
    
                if(ctype_digit($monat))
                {
                    true;
                }
                else
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Monat' dürfen nur Zahlen(1,2,3...12) verwendet werden.";
                }

                if(ctype_digit($jahr))
                {
                    true;
                }
                else
                {
                    $success = 0;
                    $fehler_nachricht[] = "Im Feld 'Jahr' dürfen nur Zahlen(1900, 1901...2021) verwendet werden.";
                }

                foreach ($fehler_email as $fehler) 
                {
                    echo '<div class="isa_error">';
                    echo ($fehler." <br />");
                    echo '</div>';
                }

                $datum_heute = time();
                $tage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");

                foreach ($fehler_nachricht as $fehler) 
                {
                    echo '<div class="isa_error">';
                    echo ($fehler." <br />");
                    echo '</div>';
                }

                if ($success == 1)
                {
                    echo '<div class="isa_success">';
                    echo "Erfolgreich erstellt!<br />";
                    echo '</div>';

                    $f = fopen("Text/daten.csv", "a");
                    $daten = array($vorname, $nachname, $email, $tag . "." . $monat . "." . $jahr, $impfstatus);

                    fputcsv($f, $daten, ";");
                    fclose($f);

                    echo '<div class="isa_info">';
                    echo 'Sie haben folgendes eingetragen: </div>';
                    echo $anrede . " " . $nachname . ", " . "<br>" . "Sie sind " . $impfstatus;
                    echo "<script>$('.contactForm')[0].reset();</script>";
                }
            }
        ?>
        </div>
            </div>
                </div>

        <div id="kopf">
            <table>
                <tr>
                    <td><a href="index.php"><img src="Bilder/logo.png" alt="logo" id="logo" /></a></td>
                    <td><a href="impressum.html">Impressum</a></td>
                    <td><a href="datenschutz.html">Datenschutz</a></td>
                    <td><a href="quellcode.php">Quelle</a></td>
                    <td><a href="https://berufskolleg.de">Schule</a></td>
                    <td><a href="https://imgur.com">Bilder</a></td>
                </tr>
            </table>
        </div>
    </body>
    <!--
        impfstatus
        filipistgeil123
     -->