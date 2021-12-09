<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<head>
    <title>Maurer</title>
    <meta http-equiv="content-type" content="text/plain; charset=utf-8" />
	<meta http-equiv="content-language" content="de" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="../style.css" />
	<link type="text/css" rel="stylesheet" href="../forumstyle.css" />
</head>

<body bgcolor="#101010">

    <div class="formbackground">
        <a href="../"><img src="../pictures/chris-industriesscaled.png" class="img" /></a>

    <?php 
        $pfad = "../data/ticketsystem/";
        $file = "ticketlog.csv";
        $zeiger = fopen($pfad.$file,"r");
        if($zeiger)
        {	
        
            echo'<center><table border = "3" id="log-table">';
            echo"<td><u><b>Vorname</u></b></td>";
            echo"<td><u><b>Nachname</u></b></td>";
            echo"<td><u><b>Telefon</u></b></td>";
            echo"<td><u><b>E-Mail</u></b></td>";
            echo"<td><u><b>Nachricht</u></b></td>";
            echo"<td><u><b>Datum</u></b></td>";
            echo"<td><u><b>Ticket Nummer</u></b></td>";
            echo"<td><u><b>Username</b></u></td>";
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
    ?>
    </div>
</body>

</html>