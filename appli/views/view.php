<html>
    <head>
        <base href="/" >
        <?php $this->render('wJavascript'); ?>
        <link REL=StyleSheet HREF="planski/appli/styles.css" TYPE="text/css" MEDIA=screen>
        <link rel="icon" type="image/png" href="planski/images/icones/Fav.png" />
        <link type="text/css" rel="stylesheet" media="all" href="planski/libraries/chat/css/chat.css" />
        <link type="text/css" rel="stylesheet" media="all" href="planski/libraries/chat/css/screen.css" />
        <link rel="stylesheet" type="text/css" href="planski/libraries/growler/css/gritter.css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>PlanSki</title>
    </head>
    <body>
        <div class="userMenu">
            <a href="home" style="position:absolute;top:5px;left:50px;">
                <img src="planski/images/structure/planski.png" />
            </a>
            <div>
                <?php if($this->context->get('user_id')) : ?>
                    <div style="position:absolute;top:25px;right:147px;">
                        <a class="menuIcone" href="mailbox"><img src="planski/images/icones/message.png" />
                            <b><?php echo $this->context->get('new_messages'); ?></b>
                        </a>
                        <a class="menuIcone" href="mailbox"><img src="planski/images/icones/alert.png" />
                            <b><?php echo $this->context->get('new_messages'); ?></b>
                        </a>
                    </div>
                    <?php $photo = empty($this->context->get('user_photo_url')) ? 'unknowUser.jpg' : $this->context->get('user_photo_url'); ?>
                    <img style="position:absolute;top:16px;right:103px;" class="connectedPhoto" src="planski/photos/profile/<?php echo $photo; ?>" />
                    <a style="position:absolute;top:25px;right:47px;" class="menuIcone"  href="#">
                        <?php echo $this->context->get('user_login'); ?>
                    </a>
                <?php else : ?>
                    <div class="greyLink" style="color: white;">
                        <form action="auth/login" method="post">
                            Login : <input style="padding-top:-10px;margin-left:5px;margin-right:5px;" name="user_login" size="4" />
                            Password : <input style="margin-left:5px;" name="user_pwd" type="password" size="4" />
                            <input type="submit" value="Connexion" />
                            <input type="button" onclick="window.location.href = 'planski/libraries/socialauth/station.php';" class="facebookButton" value="Via Facebook" />
                            <label style="margin-left:5px;" for="savepwd">Enregistrer</label><input id="savepwd" name="savepwd" type="checkbox" />
                            <a class="menuLien" style="margin-left:5px;" href="lostpwd">Mot de passe oublie</a>
                            <a class="menuLien" style="margin:0;" href="subscribe">S'inscrire !</a>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="pancarte"></div>
        <div class="site">
            <div class="menu">
                <a class="menuLien" <?php echo ($this->page == 'member') ? 'style="color:white;"' : ''; ?> href="user">Membres</a>
                <a class="menuLien" <?php echo ($this->page == 'crew') ? 'style="color:white;"' : ''; ?> href="crew">Crews</a>
                <a class="menuLien" <?php echo ($this->page == 'appart') ? 'style="color:white;"' : ''; ?> href="appart">Apparts</a>
                <?php if($this->context->get('role_id') == AUTH_LEVEL_SUPERADMIN) : ?>
                    <a class="menuLien" <?php echo ($this->page == 'admin') ? 'style="color:white;"' : ''; ?> href="admin">Admin</a></td>
                <?php endif; ?>
            </div>
            <div style="min-height: 550px;">
                <?php include($this->getViewFileName()); ?>
            </div>
        </div>
        <div class="footer">
            Réalisé par Antoine Ricci - aricci95@gmail.com
        </div>
    </body>
</html>
