<!DOCTYPE html>
<html>
<header>
    <title>Firmen Umfrage</title>
    <style>
        fieldset {
            border: none;
        }
 
        label::after {
            content: "";
            display: block;
        }
    </style>
</header>
<body>
    <h2>Rezension</h2>
	

 
<form action="Umfrage.php" method="post" enctype="text/plain">
    
    Alter:<br>
    <fieldset>
            <input type="radio" id="alter1" name="Alter" value="<10">
            <label for="alter1"><10</label>
            <input type="radio" id="alter2" name="Alter" value="10-20">
            <label for="alter2">10-20</label>
            <input type="radio" id="alter3" name="Alter" value=">20">
            <label for="alter3">>20</label>
    </fieldset>
    <br>
    Sonstiges:<br>
    <textarea name="Text1" cols="50" rows="7"></textarea>
    <br><br>
    <input type="submit" value="Absenden">
</form> 
 
</body>
</html>

