<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

    <header>
    <title>Statistik</title>
    <link type = "text/css" rel = "stylesheet" href = "../style.css" />
    <meta charset="utf-8"/>
    </header>

        <body bgcolor="#101010">
       <div class="formbackground">
           <div class="stats">
            <h1> Statistik </h1>
      
        <!--<div id="menu">
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
        <br />-->

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


         //Besuche Pro Tag
         $today = date("d.m.Y", time());
         $pfad = "../data/ticketsystem/";
		 $datei = "useraday.txt";
	     $zeiger = fopen($pfad.$datei,"r");
		 $useraday = fgets($zeiger);
		 fclose($zeiger);
         $useraday = substr($useraday,10,4);
        
         //Besuche per week
         $pfad = "../data/ticketsystem/";
		 $datei = "useraweek.txt";
	     $zeiger = fopen($pfad.$datei,"r");
		 $useraweek = fgets($zeiger);
		 fclose($zeiger);
         $useraweek = substr($useraweek,10,4);

        echo"<h2>Ticketsystem</h2>";
        echo"<h3>Gesamt Besucherzahl: ".$besuchergesamt."</h3>";

        echo"<h3>Besucherzahl pro Tag: ".$useraday."</h3>";


        echo"<h3>Abgeschickte Tickets: ".$sendcount."</h3>";

        echo"<h3>Besucherzahl pro Woche: ".$useraweek."</h3>"

        ?>
         </div>
        </div>
        </body>





</html>