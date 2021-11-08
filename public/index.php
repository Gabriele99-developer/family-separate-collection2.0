<!DOCTYPE html>
<html>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <header>
     <title>Accesso</title>
    </header>
    <body style="background-image:URL('img/collection.jpg'); background-repeat: no-repeat; background-position: center top;text-align: center; font-family:'Josefin Sans';">
        <h3 style= "color: red; font-size:30px">Accesso</h3>
        <form action="controllers/user_check.php" method="post">
            <p style= "color: white; font-size:20px; font-family:'Josefin Sans';"><b>username:<b><br/><input id="username" name="username" type="text" required /></p>
            <p style= "color: white; font-size:20px; font-family:'Josefin Sans';">password:<br/><input id="password" name="password" type="password" required /></p>
            <input  name="Submit" type="submit" id="btn_accedi" value="Accedi" OnClick="Modulo()"/>
        </form>   
    </body>
</html>