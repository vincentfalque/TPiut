<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Page de contact</title>
</head>
<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
        <label for="identity">Qui êtes-vous ? </label>
        <input id="identity" type="text" name="identity" />
        <label for="message">Saisissez votre message !</label>
        <textarea id="message" name="message" rows="5" cols="60"></textarea>
        <input type="submit" value="Envoyer" name="submit" />
    </form>

    <?php
        if(isset($_POST['submit'])) { ?>
            <h3> Message de <?php echo $_POST['identity']; ?></h3>
            <p> <?php echo $_POST['message']; ?></p>
        <?php }
    ?>
</body>
</html>