<?php
    require_once('forum.php');

    function field_empty($field, $fieldname, &$fehler_nachricht)
    {
        if($field == "")
        {
            $fehler_nachricht[] = "Der Feld <b>" . $fieldname . "</b> darf <b>nicht leer</b> sein.";
            return 0;
        }

        else
            return 1;
    }

    function field_numeric($field, $fieldname, &$fehler_nachricht)
    {
        if(ctype_digit($field))
        {
            $fehler_nachricht[] = "Der Feld <br>" . $fieldname . "</b> darf <b>keine Nummern</b> haben.";
            return 0;
        }

        else
            return 1;
    }

    function field_string($field, $fieldname, &$fehler_nachricht)
    {
        if(ctype_alpha($field))
        {
            $fehler_nachricht[] = "Der Feld <br>" . $fieldname . "</b> darf <b>keine Buchstaben</b> haben.";
            return 0;
        }

        else
            return 1;
    }

    /////////////////////////////////////////////////////////////////////////////////////

    function field_email($email, &$fehler_nachricht)
    {
        $success = 1;
        if (strpos($email, '@') == NULL)
                {
                    $fehler_nachricht[] = "In der Mail, '@' gibt es nicht.";
                    $success = 0;
                }

                $falchestelle = 0;

                if (strstr($email, '.') == NULL)
                {
                    $fehler_nachricht[] = "In der Mail, '.' gibt es nicht.";
                    $success = 0;
                    $falchestelle = 1;
                }

                if($falchestelle == 0)
                {
                    if (strpos($_POST['email'],".") == 0)
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
                            $fehler_nachricht[] = "In der Mail, '.' ist an der falsche Stelle.";
                            $success = 0;   
                        }
                    }
                }

                if (strlen($email) - 1 == strrpos($email, '.'))
                {
                    $fehler_nachricht[] = "Nach einem '.' ist weiterer Inhalt erforderlich.";
                    $success = 0;
                }

                if (strlen($email) < 6)
                {
                    $fehler_nachricht[] = "E-Mail darf mindestens 6 Zeichen sein.";
                    $success = 0;
                }

                if (strlen($email) > 320)
                {
                    $fehler_nachricht[] = "E-Mail darf maximal 320 Zeichen sein.";
                    $success = 0;
                }

                if (strpos($email, ' ') != 0)
                {
                    $fehler_nachricht[] = "E-Mail darf keine Leerzeichen haben.";
                    $success = 0;
                }

                //Ab hier bin ich schlau 
                $punkt = strpos($email, '@');
                if ($email[$punkt - 1] == '.')
                {
                    $fehler_nachricht[] = "Neben '@' darf kein '.' vorkommen"; 
                    $success = 0;
                }

                $et = strpos($email, '.');
                if ($email[$et - 1] == '@')
                {
                    $fehler_nachricht[] = "Neben '@' darf kein '.' vorkommen"; 
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
                        $fehler_nachricht[] = "E-Mail darf keine Sonderzeichen enthalten";
                        $success = 0;
                        break;
                    }
                }
        return $success;
    }