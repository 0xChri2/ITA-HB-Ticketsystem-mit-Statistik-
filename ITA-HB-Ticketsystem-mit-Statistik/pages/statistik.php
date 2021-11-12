<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
 <!-- Test--->
    <header>
    <title>Statistik</title>
    <link type = "text/css" rel = "stylesheet" href = "../style.css" />
    <meta charset="utf-8"/>
    </header>

        <body bgcolor="#101010">
        <div id="heading">
            <h1> Statistik </h1>
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
        <br />

        <?php 
        //Besuchergesamt
         $pfad = "../data/ticketsystem/";
         $datei = "usercount.txt";
         $zeiger = fopen($pfad.$datei,"r");
         $besuchergesamt = fgets($zeiger);
         fclose($zeiger);
        
         //Abgeschickte Tickets
         $datei = "sendcount.txt";
         $zeiger = fopen($pfad.$datei,"r");
         $sendcount = fgets($zeiger);
         fclose($zeiger);
         
         


        echo"<h2>Ticketsystem</h2>";
        echo"<h3>Gesamt Besucherzahl: ".$besuchergesamt."</h3>";

        echo"<h3>Beuscherzahl pro Tag:</h3>";


        echo"<h3>Abgeschickte Tickets: ".$sendcount."</h3>";
        ?>
       
        </body>





</html>