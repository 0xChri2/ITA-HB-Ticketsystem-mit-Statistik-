<!-- ImChri2 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<head>
    <title>Ticket</title>
    <meta http-equiv="content-type" content="text/plain; charset=utf-8" />
	<meta http-equiv="content-language" content="de" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="../css/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/forumstyle.css" />
</head>

<body bgcolor="#101010">

    <div class="formbackground">
        <a href="../"><img src="../pictures/chris-industriesscaled.png" class="img" /></a>
        <div class="form">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="headline">
                    <h1>REGISTER</h1><br>
                </div>
                <div class="salutation">
                    <div class="mr">
                        <input type="radio" name="Anrede" value="Herr" required>Herr</input>
                    </div>
                    <div class="mrs">
                        <input type="radio" name="Anrede" value="Frau" required>Frau</input>
                    </div><br>
                </div>
                <br /> <br />
				<div class="input-container">
                    <input type="text" name="vorname" required="" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['vorname']. '"';}?> />
                    <label>Vorname</label>
                </div>
				<div class="input-container">
                    <input type="text" name="nachname" required="" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['nachname']. '"';}?> />
                    <label>Nachname</label>
                </div>
				<div class="input-container">
                    <input type="text" name="telefon" required="" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['telefon']. '"';}?> />
                    <label>Telefon</label>
                </div>
                <div class="input-container">
                    <input type="text" name="e-mail" required="" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['e-mail']. '"';}?>/>
                    <label>Email</label>
                </div><br>
                Nachricht<br><br>
                <textarea name="message" <?php if(isset($_POST['Senden'])==true){echo 'value="'.$_POST['message']. '"';}?>></textarea>
                <br />

                <input type="submit" name="Senden" value="Senden" class="btn" />
                <input type="reset" />
			</form>

			<form action="log-table.php">
				<input type="submit" name="log" class="logdata" value="Log Datei" />
			</form>

			</div>

        <?php
			include ("../lib/phpqrcode/qrlib.php");
			include ("../lib/form_validation.php");
			if(isset($_POST['Senden'])==true)
			{			
				//countsenden
				$pfad = "../data/ticketsystem/";
				$datei = "sendcount.txt";
				$zeiger = fopen($pfad.$datei,"r");
				$send = fgets($zeiger);
				$sendarray = explode("\t",$send);
				fclose($zeiger);

				$send = $sendarray[0] + 1;
				$pfad = "../data/ticketsystem";
				$datei = "sendcount.txt";
				$message = $send ."\t";
				$zeiger = fopen($pfad.$datei,"w");
				fputs($zeiger,$message);
				fclose($zeiger);

				//error message 
				$error = false;
				$fehler_nachricht=array();
				
				//Anrede 
				$anrede = $_POST['Anrede'];
				

				//vorname
				$vorname = trim($_POST['vorname']);
				if(field_vorname($vorname, $fehler_nachricht) == 0)
				{
				$error = true;
				}
				$vorname = ucwords($vorname);

				
				//nachname
				$nachname = trim($_POST['nachname']);
				if(field_nachname($nachname, $fehler_nachricht) == 0)
				{
				$error = true;
				}
				$nachname = ucfirst($nachname);


				//telefon
				$telefon = trim($_POST['telefon']);
				if(field_phonenumber($telefon, $fehler_nachricht) == 0)
				{
					$error = true;
				}


				//email
				$email = strtolower(trim($_POST['e-mail']));
				if(field_email($email, $fehler_nachricht) == 0)
				{
					$error = true;
				}

				//Textbox
				$message = trim($_POST['message']);

				//username 
				$username = date("Y-m-d-H:i",time())."-". strtoupper(substr($nachname, 0, 3))."-".strtoupper(substr($vorname, 0, 3))."-".substr($telefon, -3); 
					

					//error message
					if($error == true)
					{
						echo"<div class='output'><div class='centertext'><h1>Fehlermeldung</h1></div><br/>";
					}
					foreach ($fehler_nachricht as $fehler)
					{		
						echo "<div class='centertext'><h2>".$fehler."</h2></div>";
					}
				
					
					//success message
					
					if($error == false)
					{	
						//echo"<div class='output'>";
						echo"<br /><br /><div class='centertext'><h2> Vielen Dank, ". $anrede . " " . $_POST['nachname'] . ". Wir melden uns bald bei Ihnen!</h4>";
						echo "<h4>Wenn Sie fragen oder Probleme haben Kontakieren sie uns über +49 12345678</h4>";
						echo"<br /><h3>Ihre Nachricht an uns ist: <br />".$message."</h3>";
						echo"<br /><h3>Ihre Name ist: ".$vorname." ".$nachname."</h3>";
						echo"<h3>Ihre Telfonnummer ist: ".$telefon."</h3>";
						echo"<h3>Ihre E-Mail ist: ".$email."</h3>";
						echo"<h3>Ihr Username ist: ".$username."</h3>";

						//Ticket System
						//Read
						$year = time();
						$year = date("Y",$year);
						$pfad = "../data/ticketsystem/";
						$file = "ticket.docx";
						$zeiger = fopen($pfad.$file,"r");
						$dieseZeile = fgets($zeiger,4096);
						$zeilenarray = explode("\t",$dieseZeile);
						echo'<br /><br /><div class="centertext"><h2>Ticket Nummer:<br />'.$year.'.'.$zeilenarray[0].'</h2></div></div>';
						fclose($zeiger);
						$TicketNr = $zeilenarray[0];

						//Log Write	
						$today = time();
						$today = date("d.m.Y - H:i",$today);
						$file = "ticketlog.csv";
						$messagelog = $vorname ."\t". $nachname ."\t".$telefon."\t".$email."\t".$message."\t".$today."\t".$year.".".$TicketNr."\t".$username ."\n";
						$zeiger = fopen($pfad.$file,"a+");
						fputs($zeiger,$messagelog);
						fclose($zeiger);	

						//qrcode
						$qrlink = "../data/ticketsystem/qrcode/".$TicketNr.".png";
						QRcode::png($messagelog, $qrlink, 'Q', 4, 2);

						//Write Ticket
						$pfad = "../data/ticketsystem/";
						$file = "ticket.docx";
						$TicketNr = $TicketNr +1;
						$zeiger = fopen($pfad.$file,"w");
						$messageticket = $TicketNr ."\t";
						fputs($zeiger,$messageticket);
						fclose($zeiger);
	
						
					}					

				

			}		

			//BesucherGesamt read
			$pfad = "../data/ticketsystem/";
			$datei = "usercount.txt";
			$zeiger = fopen($pfad.$datei,"r");
			$usercount = fgets($zeiger);
			$usercountarray = explode("\t",$usercount);
			fclose($zeiger);

			//BeucherGesamt write
			$usercount = $usercountarray[0] + 1;
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
				$useradayold = explode("\t",$useraday);
				$useradaynew = intval($useradayold[1]) + 1;
				$message = $today ."\t". $useradaynew. "\n";
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
				
				//Besucher per week write
				$useraweekold = explode("\t",$useraweek);
				$pfad = "../data/ticketsystem/";
				$datei = "useraweek.txt";
				$useraweeknew = intval($useraweekold[1]) + 1;
				$message = $today ."\t". $useraweeknew. "\n";
				$zeiger = fopen($pfad.$datei,"w+");
				fputs($zeiger,$message);
				fclose($zeiger);

		?>

    </div>

</body>

</html>