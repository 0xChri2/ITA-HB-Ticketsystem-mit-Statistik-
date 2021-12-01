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
						<li class="submenu"><a href="ticketsystem.php">Ticketsystem</a></li>
						<li class="submenu"><a href="forum.php">Forum</a></li>
						<li class="submenu"><a href="umfrage.php">Umfrage</a></li>
						<li class="submenu"><a href="statistik.php">Statistik</a></li>
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
				<h3>Vorname: <input type="text" name="vorname"  <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['vorname']. '"';} else {echo "placeholder='Max'";} ?> /></h3>
				<h3>Nachname: <input type="text" name="nachname" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['nachname']. '"';} else {echo "placeholder='Mustermann'";} ?>/></h3>   
				<h3>Telefon: <input type="tel" size="16" name="telefon"<?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['telefon']. '"';} else {echo "placeholder='+12345678'";} ?> require/></h3>
				<h3>E-Mail: <input type="text" name="e-mail" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['e-mail']. '"';} else {echo "placeholder='Muster.mail@mail.com'";} ?>/></h3>
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
			include "../lib/phpqrcode/qrlib.php";
			if(isset($_POST['Senden'])==true)
			{			
				//countsenden
				$send = $send + 1;
				$pfad = "../data/ticketsystem";
				$datei = "sendcount.txt";
				$message = $send ."\t";
				$zeiger = fopen($pfad.$datei,"w");
				fputs($zeiger,$message);
				fclose($zeiger);

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

						//Ticket System
						//Read
						$year = time();
						$year = date("Y",$year);
						$pfad = "../data/ticketsystem/";
						$file = "ticket.docx";
						$zeiger = fopen($pfad.$file,"r");
						$dieseZeile = fgets($zeiger,4096);
						$zeilenarray = explode("\t",$dieseZeile);
						echo'<br /><br /><div class="centertext"><h2>Ticket Nummer:<br />'.$year.'.'.$zeilenarray[0].'</h2></div>';
						fclose($zeiger);
						$TicketNr = $zeilenarray[0];

						//Log Write	
						$today = time();
						$today = date("d.m.Y - H:i",$today);
						$file = "ticketlog.csv";
						$username = date("Y-m-d-H:i",time())."-". substr($nachname, 0, 3)."-".substr($vorname, 0, 3)."-".substr($telefon, -3); // weiß ich nich ob das geht
						$messagelog = $vorname ."\t". $nachname ."\t".$telefon."\t".$email."\t".$message."\t".$today."\t".$year."\t".$username ."\n";
						$zeiger = fopen($pfad.$file,"a+");
						fputs($zeiger,$messagelog);
						fclose($zeiger);	

						//Write Ticket
						$pfad = "../data/ticketsystem/";
						$file = "ticket.docx";
						$TicketNr = $TicketNr +1;
						$zeiger = fopen($pfad.$file,"w");
						$messageticket = $TicketNr ."\t";
						fputs($zeiger,$messageticket);
						fclose($zeiger);
	
						//qrcode
						$qrlink = "../data/ticketsystem/qrcode/".$TicketNr.".png";
						QRcode::png($messagelog, $qrlink, 'L', 4, 2);
					}					

				

			}	


			//Log Datei ausgabe
				if(isset($_POST['Logdata'])==true)
				{
					$pfad = "../data/ticketsystem/";
					$file = "ticketlog.csv";
					$zeiger = fopen($pfad.$file,"r");
					if($zeiger)
					{	

						echo'<center><table border = "3">';
						echo"<td><u><b>Varname</u></b></td>";
						echo"<td><u><b>Nachname</u></b></td>";
						echo"<td><u><b>Telefon</u></b></td>";
						echo"<td><u><b>E-Mail</u></b></td>";
						echo"<td><u><b>Nachricht</u></b></td>";
						echo"<td><u><b>Datum</u></b></td>";
						echo"<tf><u><b>Ticket Nummer</u></b></td>";
						echo"<tf><u><b>Username</b></u></tf>";
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

			//BesucherGesamt read
			$pfad = "../data/ticketsystem/";
			$datei = "usercount.txt";
			$zeiger = fopen($pfad.$datei,"r");
			$usercount = fgets($zeiger);
			fclose($zeiger);

			//BeucherGesamt write
			$usercount = $usercount + 1;
			$message = $usercount ."\t";
			$zeiger = fopen($pfad.$datei,"w");
			fputs($zeiger,$message);
			fclose($zeiger);

			//Besucher pro Tag
			$useraday = 0;
			$time = time();
			$today = date("d.m.Y", time());
			$lastday = time() - 86400;
			$lastday = date("d.m.Y",$lastday);

				//Besucher per day read
				$pfad = "../data/ticketsystem/";
				$datei = "useraday.txt";
				$zeiger = fopen($pfad.$datei,"r");
				$useraday = fgets($zeiger);
				fclose($zeiger);
				$useradaydate = substr($useraday,0,10);
				$useraday = substr($useraday,10,4);
				
				if(date("d.m.Y",strtotime($useradaydate)) != $today)
				{
					$useraday = 0;
				}

				//Besucher per day write
				$pfad = "../data/ticketsystem/";
				$datei = "useraday.txt";
				$useraday = $useraday + 1;
				$message = $today ."\t". $useraday. "\n";
				$zeiger = fopen($pfad.$datei,"w+");
				fputs($zeiger,$message);
				fclose($zeiger);


			//Besucher per week
			$month = date("m",time());

				//Besucher per week read
				$pfad = "../data/ticketsystem/";
				$datei = "useraweek.txt";
				$zeiger = fopen($pfad.$datei,"r");
				$useraweek = fgets($zeiger);
				fclose($zeiger);
				$useraweekdate = substr($useraweek,0,10);
				$useraweek = substr($useraweek,10,4);
				
				if(date("m",strtotime($useraweekdate)) != $month)
				{
					$useraweek = 0;
				}
				
				//Besucher per day write
				$pfad = "../data/ticketsystem/";
				$datei = "useraweek.txt";
				$useraweek = $useraweek + 1;
				$message = $today ."\t". $useraweek. "\n";
				$zeiger = fopen($pfad.$datei,"w+");
				fputs($zeiger,$message);
				fclose($zeiger);

		?>      


        </div>


       <div id="footer">
              <a href="Impressum.php">Impressum</a> | <a href="Kontakte.php"> Kontakt </a>
        </div>

   
</body>
</html>

