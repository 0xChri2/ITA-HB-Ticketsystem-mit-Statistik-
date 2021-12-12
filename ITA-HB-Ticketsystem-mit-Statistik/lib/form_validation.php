<?php

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
                    $fehler_nachricht[] = "In der E-Mail ist kein '@' Zeichen vorhanden.";
                    $success = 0;
                }

                $falchestelle = 0;

                if (strstr($email, '.') == NULL)
                {
                    $fehler_nachricht[] = "In der E-Mail ist kein '.' vorhanden.";
                    $success = 0;
                    $falchestelle = 1;
                }

                if($falchestelle == 0)
                {
                    if (strpos($email,".") == 0)
                    {
                        $fehler_nachricht[]= "Der Punkt darf in der E-Mail nicht an der erster Stelle stehen!";
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
                            $fehler_nachricht[] = "In der E-Mail steht der Punkt an der falschen Stelle.";
                            $success = 0;   
                        }
                    }
                }

                if (strlen($email) - 1 == strrpos($email, '.'))
                {
                    $fehler_nachricht[] = "Nach einem '.' sind weiterer Inhalte erforderlich.";
                    $success = 0;
                }

                if (strlen($email) < 6)
                {
                    $fehler_nachricht[] = "E-Mail muss mindestens 6 Zeichen lang sein.";
                    $success = 0;
                }

                if (strlen($email) > 320)
                {
                    $fehler_nachricht[] = "E-Mail darf maximal 320 Zeichen lang sein.";
                    $success = 0;
                }

                if (strpos($email, ' ') != 0)
                {
                    $fehler_nachricht[] = "Die E-Mail darf keine Leerzeichen enthalten.";
                    $success = 0;
                }

                $punkt = strpos($email, '@');
                $punkt = $punkt  - 1;
                if ($email[$punkt] == '.')
                {
                    $fehler_nachricht[] = "Neben einem '@' darf kein '.' vorkommen"; 
                    $success = 0;
                }

                $et = strpos($email, '.');
                $et = $et -1;
                if ($email[$et] == '@')
                {
                    $fehler_nachricht[] = "Neben einem '@' darf kein '.' vorkommen"; 
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
                        $email[$i] != '9' &&
                        $email[$i] != ' ')
                    {
                        $fehler_nachricht[] = "Die E-Mail darf keine Sonderzeichen oder Umlaute enthalten";
                        $success = 0;
                        break;
                    }
                }
                if(substr($email, -1,1)==".")
				{
					$success = 0;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält einen Punkt am Ende. ";
				}

				if(substr($email, -1,1)=="@")
				{
					$success = 0;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält einen @ am Ende. ";
				}
                if((strpos($email, "@")) != (strrpos($email, "@")))
				{
					$success = 0;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält zu viele @ Zeichen. ";
				}
        return $success;
    }

    function field_vorname($vorname, &$fehler_nachricht)
    {   
        $success = 1;
        if($vorname=="")
		{
				$success = 0;
				$fehler_nachricht[]="Geben Sie bitte Ihren Vornamen an.";
		}
        return $success;
    }

    function field_nachname($nachname, &$fehler_nachricht)
    {
        $success = 1;
        if($nachname=="")
		{
				$success = 0;
				$fehler_nachricht[]="Geben Sie bitte Ihren Nachnamen an.";
		}
        return $success;
    }

    function field_phonenumber($telefon, &$fehler_nachricht)
    {   
        $success = 1;
        if($telefon=="")
		{
		    $success = 0;
	        $fehler_nachricht[]="Geben Sie bitte Ihren Telefonnummer an";
		}

        if(strpos($telefon, "+") != NULL)
        {
            $success = 0;
            $fehler_nachricht[]="Ihre Telefonnummer muss mit einem Plus beginnen.";
        }

        if(strpos($telefon, "+") != 0)
        {
            $success = 0;
            $fehler_nachricht[]="Das Plus muss am Anfang stehen.";
        }
		
        if(strrpos($telefon, "+")!= strpos($telefon,"+"))
	    {
	        $success = 0;
	        $fehler_nachricht[]="Bitte nutzen Sie nur ein Pluszeichen in der Telefonnummer.";
		}

        if(strlen($telefon) >= 15)
        {
            $success = 0;
            $fehler_nachricht[]="Ihre Telefonnummer ist zu lang.";
        }

        if(strlen($telefon) <= 8)
        {
            $success = 0;
            $fehler_nachricht[]="Ihre Telefonnummer ist zu kurz.";
        }
        
        return $success;
    }