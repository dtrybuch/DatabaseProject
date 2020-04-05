<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet" type="text/css">
     <script src="js/addAppointment.js" type="text/javascript"></script>
    <title><?php echo $title ?></title>
</head>
<body>
    <div id = "zalogowany">Zalogowano jako: <?php echo $user; ?></div><br>
    <header><h1>Witamy w naszej przychodni!!!</h1></header>
    <?php echo $nav ?>
    <header><h2><?php echo $header ?></h2></header>
    <div id="content"><?php echo $content ?>
    </div><br>
    <a href="index.php" id="ReturnButton">Przejdź do strony głównej </a><br>
    <br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>
</body>
<footer style="clear:both;">Projekt na Bazy Danych - Dominik Trybuch. &copy; Wszelkie prawa zastrzezone.</footer>
</html>