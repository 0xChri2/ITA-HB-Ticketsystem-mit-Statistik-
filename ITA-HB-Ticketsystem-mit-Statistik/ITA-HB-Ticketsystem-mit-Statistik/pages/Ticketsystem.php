<!-- ImChri2 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
	 <head>
		  <title>Maurer</title>
		  <meta http-equiv="content-type" content="text/plain; charset=utf-8" />
		  <meta http-equiv="content-language" content="de" />
		  <link type = "text/css" rel = "stylesheet" href = "../style.css" />
	</head>

<body bgcolor="#101010">

        <div id="heading">
            <h1> Maurer </h1>


        </div>
        <div id="menu">
            <ul>
                <li class="topmenu">
                    <a href=""><img src="../pictures/Drei Striche.png" alt="Drei Striche"/></a>
                    
					<ul>
                    <li class="submenu"><a href="../index.php">Startseite</a></li>
						<li class="submenu"><a href="Ticketsystem.php">Ticketsystem</a></li>
						<li class="submenu"><a href="Forum.php">Forum</a></li>
						<li class="submenu"><a href="Kontakte.php">Kontakte</a></li>
						<li class="submenu"><a href="Impressum.php">Impressum</a></li>
						
                    </ul>
                </li>
                
            </ul>
        </div>
        <div id="banner">
        </div>
        <div id="article">

		<?php 
			//if(isset($_POST['Senden'])==0)
			//{
		?>

        <form action="" method="post">
		<div class="headline"><h1><u>Maurer</u></h1></div>
		<div class="form">
			<center>	
			<p>
				Anrede <select name="Anrede" size="1" value="<?php echo $_POST['Anrede'] ?>">
				<option>Herr</option>
				<option>Frau</option>
				</select>
				<br /><br />
				Vorname:<input type="text" name="vorname"  <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['vorname']. '"';} else {echo "placeholder='Max'";} ?> /><br /><br />
				Nachname:<input type="text" name="nachname" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['nachname']. '"';} else {echo "placeholder='Mustermann'";} ?>/><br /><br />      
				Telefon:<input type="tel" name="telefon"<?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['telefon']. '"';} else {echo "placeholder='+12345678'";} ?> require/><br /><br />
				E-Mail:<input type="text" name="e-mail" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['e-mail']. '"';} else {echo "placeholder='Muster.mail@mail.com'";} ?>/><br /><br />
				<h3>Nachricht</h3>
				<textarea name="message" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['message']. '"';} else {echo "placeholder='Malen Sie bitte alle Wände in Weiß an.'";} ?>cols="50" rows="10" require> 
				</textarea>
				
			<hr />
			
			<input type="submit" name="Senden" value="Anfrage abschicken!"/>
			<input type="reset"/>
			<input type="submit" name="Logdata" value="Log Datei"/>
			</p>
			</center>
		</div>
        </form>
		
		<?php
			
			if(isset($_POST['Senden'])==true)
			{			

				//error message 
				$error = false;
				$fehler_nachricht=array();
			

				//vorname
				$vorname = trim($_POST['vorname']);
				if($vorname=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Vornamen ein.";
				}
				$vorname = ucwords($vorname);

				//nachname
				$nachname = trim($_POST['nachname']);
				if($nachname=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Nachnamen ein.";
				}
				$nachname = ucfirst($nachname);

				//telefon
				$telefon = trim($_POST['telefon']);
				if($telefon=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Telefonnummer an";
				}
				if(strrpos($telefon, "+")!= strpos($telefon,"+"))
				{
				$error = true;
				$fehler_nachricht[]="Bitte nutzen Sie nur ein Pluszeichen in der Telefonnummer.";
				}


				//strasse
				$strasse = $_POST['strasse'];
				if($strasse=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Strassennamen an";
				}


				//hausnummer
				$hausnummer = $_POST['hausnummer'];
				if($hausnummer=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Hausnummer an";
				}


				//stadt
				$stadt = trim($_POST['stadt']);
				if($stadt=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Stadtnamen an";
				}
				

				//postleitzahl
				$postleitzahl = trim($_POST['postleitzahl']);
				if($postleitzahl=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte Ihren Postleitzahl an";
				}
				if(strlen($postleitzahl) < "5") 
				{
					$error = true;
					$fehler_nachricht[]="Ihre Postleitzahl ist zu kurz.";
				}
				if(strlen($postleitzahl) > "5") 
				{
					$error = true;
					$fehler_nachricht[]="Ihre Postleitzahl ist zu lang.";
				}


				//email
				$email = trim($_POST['e-mail']);
				if($email=="")
				{
				$error = true;
				$fehler_nachricht[]="Geben Sie bitte ihren E-Mail ein";
				}

				if(strpos($email, "@")== false)
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält kein @ Zeichen oder es steht am Anfang. ";
				}

				if((strpos($email, "@")) != (strrpos($email, "@")))
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält zu viele @ Zeichen. ";
				}

				if((strpos($email, "."))== false)
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält kein Punkt oder er steht am Anfang. ";
				}

				if((strpos($email, " "))== true)
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält ein Leerzeichen. Bitte geben Sie ihre E-Mail Adresse ohne Leerzeichen an. ";
				}

				if(substr($email, -1,1)==".")
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält einen Punkt am Ende. ";
				}

				if(substr($email, -1,1)=="@")
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse enthält einen @ am Ende. ";
				}

				if(strlen($email) < "6") 
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse ist zu kurz. ";
				}

				if(strlen($email) > "320") 
				{
					$error = true;
					$fehler_nachricht[]="Ihre E-Mail Adresse ist zu lang. ";
				}

				if((strrpos($email, "."))<(strrpos($email, "@")))
				{
					$error = true;
					$fehler_nachricht[]="Ihr letzter Punkt ist nicht an der richtigen Stelle. Bitte schauen Sie sich die E-Mail nocheinmal an.";
				}
				
				 $umlaute = array('ä','Ä','ü','Ü','ö','Ö');
				for($i = 0; $i >= 5;$i++)
				{
					if(strpos($email,$umlaute[$i]))
					{
						$error = true;
						$fehler_nachricht[]="Ihre E-Mail enthält unzulässige Umlaute.";
						break;
					}
					
				}


					//Wunschtermin
					$TerminW1 = strtotime($_POST['TerminW1']);
					$TerminW2 = strtotime($_POST['TerminW2']);
					$TerminW3 = strtotime($_POST['TerminW3']);
				
					$DateA = date("d.m.Y",$TerminW1);
					$DateB = date("d.m.Y",$TerminW2);
					$DateC = date("d.m.Y",$TerminW3);
					$today = time();
					$todaydate = strtotime($today);
					

					//Zeit bis zum Wunschtermin
					$daysleftA = (strtotime($DateA)-$today)/60/60/24;
					$daysleftB = (strtotime($DateB)-$today)/60/60/24;
					$daysleftC = (strtotime($DateC)-$today)/60/60/24;


					//Tag des Termins 
					$dayk = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
					$TermintagA = date("d", strtotime($daysleftA));
					$TermintagB = date("d", strtotime($daysleftB));
					$TermintagC = date("d", strtotime($daysleftC));
					$dayA = $dayk [date("w", $TerminW1)];
					$dayB = $dayk [date("w", $TerminW2)];
					$dayC = $dayk [date("w", $TerminW3)];


					//Wunschtermin check 
					if($today > strtotime($DateA))
					{
						$error = true;
						$fehler_nachricht[]="Ihr 1. Wunschtermin ist in der Vergangenheit.";
					}

					if($today > strtotime($DateB))
					{
						$error = true;
						$fehler_nachricht[]="Ihr 2. Wunschtermin ist in der Vergangenheit.";
					}

					if($today > strtotime($DateC))
					{
						$error = true;
						$fehler_nachricht[]="Ihr 3. Wunschtermin ist in der Vergangenheit.";
					}

					if($dayA == "Sonntag")
					{
						$error = true;
						$fehler_nachricht[]="Ein Sonntag als Wunschtermin ist leider nicht möglich.";
					}

					if($dayB == "Sonntag")
					{
						$error = true;
						$fehler_nachricht[]="Ein Sonntag als Wunschtermin ist leider nicht möglich.";
					}

					if($dayC == "Sonntag")
					{
						$error = true;
						$fehler_nachricht[]="Ein Sonntag als Wunschtermin ist leider nicht möglich.";
					}


				//Textbox
				$message = trim($_POST['message']);
					

				//error message
				if($error == true)
				{
					echo"<div class='centertext'><h1>Fehlermeldung</h1></div><br/>";
				}
				foreach ($fehler_nachricht as $fehler)
				{		
					echo "<div class='centertext'><h2>".$fehler."</h2></div>";
				}
				

				//success message
				$anrede = $_POST['Anrede'];
				if($error == false)
				{
				echo"<br /><br /><div class='centertext'><h2> Vielen Dank, ". $_POST['Anrede'] . " " . $_POST['nachname'] . ". Wir melden uns bald bei Ihnen!</h4>";
				echo "<h4>Wenn Sie fragen oder Probleme haben Kontakieren sie uns über +49 12345678</h4>";
				echo"<br /><h3>Ihre Nachricht an uns ist: <br />".$message."</h3>";
				echo"<br /><h3>Ihre Name ist: ".$vorname." ".$nachname."</h3>";
				echo"<h3>Ihre Telfonnummer ist: ".$telefon."</h3>";
				echo"<h3>Ihre E-Mail ist: ".$email."</h3>";
				echo"<h3>Ihre Adresse ist: ".$strasse." ".$hausnummer." in ".$stadt." ".$postleitzahl."</h3>";
				echo"<br /><h3>Ihre Wunsch Termin 1 ist <br />". $DateA ."</h3>";
				echo"<h3> Tage bis zum 1.Termin ist: ". ceil($daysleftA) ."</h3>";
				echo"<h3> Tag des 1. Termins: ". $dayA ."</h3>";

				echo"<br /><br /><h3>Ihre Wunsch Termin 2 ist <br />". $DateB ."</h3>";
				echo"<h3> Tage bis zum 2.Termin ist: ". ceil($daysleftB) ."</h3>";
				echo"<h3> Tag des 2. Termins: ". $dayB ."</h3>";

				echo"<br /><br/><h3>Ihre Wunsch Termin 3 ist <br />". $DateC ."</h3>";
				echo"<h3> Tage bis zum 3.Termin ist: ". ceil($daysleftC) ."</h3>";
				echo"<h3> Tag des 3. Termins: ". $dayC ."</h3>";
				
				if($dayA == "Samstag")
				{
					echo"<h2>Bitte beachten Sie, dass Samstage extra Kosten verursachen.</h2>";
				}
				if($dayB == "Samstag")
				{
					echo"<h2>Bitte beachten Sie, dass Samstage extra kosten verursachen.</h2>";
				}if($dayC == "Samstag")
				{
					echo"<h2>Bitte beachten Sie, dass Samstage extra kosten verursachen.</h2></div>";
				}


				//Ticket System
				//Read
				$year = time();
				$year = date("Y",$year);
				$pfad = "../data/";
                $messagetxt = "Ticket.docx";
				$zeiger = fopen($pfad.$messagetxt,"r");

			
				if($zeiger)
				{	
						$dieseZeile = fgets($zeiger,4096);
						$zeilenarray = explode("\t",$dieseZeile);
						echo'<br /><br /><div class="centertext"><h2>Ticket Nummer:<br />'.$year.'.'.$zeilenarray[0].'</h2></div>';
						fclose($zeiger);
						$TicketNr = $zeilenarray[0];

						//Log Write	
						$today = time();
						$today = date("d.m.Y - H:i",$today);
						$TerminW1 = date("d.m-Y", $TerminW1);
						$TerminW2 = date("d.m-Y", $TerminW2);
						$TerminW3 = date("d.m-Y", $TerminW3);
        		        $messagetxt = "Ticketlog.docx";
						$formdata = $vorname ."\t". $nachname ."\t". $strasse."\t".$hausnummer."\t".$stadt."\t".$postleitzahl."\t".$telefon."\t".$email."\t".$TerminW1."\t".$TerminW2."\t".$TerminW3."\t".$message."\t".$today."\t".$year.".".$TicketNr."\n";
						$zeiger = fopen($pfad.$messagetxt,"a+");
						fputs($zeiger,$formdata);
						fclose($zeiger);	

						//Write Ticket
						$pfad = "../data/";
                		$messagetxt = "Ticket.docx";
						$TicketNr = $TicketNr +1;
						$zeiger = fopen($pfad.$messagetxt,"w");
						$formdata = $TicketNr ."\t";
						fputs($zeiger,$formdata);
						fclose($zeiger);
				}
				}				

			}


			//Log Datei ausgabe
			if(isset($_POST['Logdata'])==true)
			{
				$pfad = "../data/";
                $messagetxt = "Ticketlog.docx";
				$zeiger = fopen($pfad.$messagetxt,"r");
				if($zeiger)
				{	

					echo'<center><table border = "3">';
					echo"<td><u><b>Varname</u></b></td>";
					echo"<td><u><b>Nachname</u></b></td>";
					echo"<td><u><b>Strasse</u></b></td>";
					echo"<td><u><b>Hausnummer</u></b></td>";
					echo"<td><u><b>Stadt</u></b></td>";
					echo"<td><u><b>Postleitzahl</u></b></td>";
					echo"<td><u><b>Telefon</u></b></td>";
					echo"<td><u><b>E-Mail</u></b></td>";
					echo"<td><u><b>Wunschtermin1</u></b></td>";
					echo"<td><u><b>Wunschtermin2</u></b></td>";
					echo"<td><u><b>Wunschtermin3</u></b></td>";
					echo"<td><u><b>Nachricht</u></b></td>";
					echo"<td><u><b>Datum</u></b></td>";
					echo"<td><u><b>Ticket Nummer</u></b></td>";
					while(!feof($zeiger))
					{	
						echo '<tr>';
						$dieseZeile = fgets($zeiger,4096);
						$zeilenarray = explode("\t",$dieseZeile);
						foreach($zeilenarray as $TicketNr)
						{
							echo'<td>'.$TicketNr.'</td>';
						}
						echo'</tr>';	
					}
					
					echo'</table></center><br />';
					fclose($zeiger);
			}
			}
		
		?>      


        </div>


        <div id="footer">
              <a href="Impressum.php">Impressum</a> | <a href="Kontakte.php"> Kontakt </a>
        </div>

   
</body>
</html>

