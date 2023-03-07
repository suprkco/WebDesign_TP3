<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
                Authentification
        </title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
        <link rel="shortcut icon" href="bootstrap/img/brain_icon_2.ico"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div id="content" class="span9">
                    <div class="main_body">
                    
                        <!-- Header widget -->
                        <?php include './Elements/header.php';?>
                        
                        <!-- Login panel -->
                        <div id="login-pane">

                            <div>
                                <form action="../Controller/authentification.php" method="POST">
                                    <br/>
                                    <label>Login :</label>
                                        <input id="form_login" type="text" name="login" size="26"/><br/>
                                    <label>Mot de passe :</label>
                                        <input id="form_pass" type="password" name="password" size="26"/><br/>
                                    <input type="submit" name="valider" value = "connexion"/>
                                </form>
                            </div>

                        </div>  
                        
                    </div>

                    <!-- Footer widget -->
                    <?php include './Elements/footer.php';?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js')}}"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>
