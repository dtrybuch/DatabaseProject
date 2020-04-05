
    <header><h1>Proszę podać dane gabinetu!</h1></header>
    <form name="gabinetForm" method="post" action="controllers.php?sub=Admin&action=addCabinetPost">
    <input type="number" id="nr" name="nr" placeholder="Numer gabinetu:">
    <input type="number" id="floor" name="floor" placeholder="Numer piętra">
    <br><br><input type="submit" id="SubmitButton" value="Potwierdz">
    </form>
    <br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>