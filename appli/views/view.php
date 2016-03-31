<html>
    <head>
        <base href="/" >
        <?php $this->render('wJavascript'); ?>
        <link REL=StyleSheet HREF="planski/appli/styles.css" TYPE="text/css" MEDIA=screen>
        <link rel="icon" type="image/png" href="planski/images/icones/fav.gif" />
        <link type="text/css" rel="stylesheet" media="all" href="planski/libraries/chat/css/chat.css" />
        <link type="text/css" rel="stylesheet" media="all" href="planski/libraries/chat/css/screen.css" />
        <link rel="stylesheet" type="text/css" href="planski/libraries/growler/css/gritter.css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>PlanSki</title>
    </head>
    <body>
        <div class="userMenu">
            <a href="plans" style="position:absolute;top: 10px;left: 29px;;">
                <img src="planski/images/structure/planski.png" />
            </a>
            <div>
                <?php if($this->context->get('user_id')) : ?>
                    <a href="mailbox" style="position:absolute;right:16%;top: 32px;"><img src="planski/images/icones/message.png" /></a>
                    <a href="mailbox" style="position:absolute;right:19%;top: 29px;"><img src="planski/images/icones/alert.png" /></a>
                    <?php if (!empty($this->context->get('new_messages'))) : ?>
                        <div class="counter" style="right:15%;top:13px;"><?php echo $this->context->get('new_messages'); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($this->context->get('new_notification'))) : ?>
                        <div class="counter" style="right:18%;top:13px;"><?php echo $this->context->get('new_notification'); ?></div>
                    <?php endif; ?>
                    <?php $photo = empty($this->context->get('user_photo_url')) ? 'unknown.png' : $this->context->get('user_photo_url'); ?>
                    <img style="position:absolute;top: 20px;left:86%" class="connectedPhoto" src="planski/photos/profile/<?php echo $photo; ?>" />
                    <img class="onglet" style="top: 46px;left: 90%;" src="planski/images/icones/onglet.png" />
                    <a style="position:absolute;top:28px;left:89%;" class="dropdown" href="#">
                        <?php echo $this->context->get('user_login'); ?><i class="caret" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdownOption" href="profile/edit">Profil</a>
                        </li>
                        <li>
                            <a class="dropdownOption" href="plan/feed/1">Mes plans</a>
                        </li>
                        <li>
                            <a class="dropdownOption" href="auth/disconnect">Déconnexion</a>
                        </li>
                    </ul>
                <?php else : ?>
                    <span class="greyLink" style="text-align:center; color: white;">
                        <form action="auth/login" method="post">
                            Login : <input style="margin-top: 11px;margin-left:5px;margin-right:5px;" name="user_login" size="8" />
                            Password : <input style="margin-left:5px;" name="user_pwd" type="password" size="8" />
                            <input type="submit" value="Connexion" />
                            <input type="button" onclick="window.location.href = 'planski/libraries/socialauth/station.php';" class="facebookButton" value="Via Facebook" />
                            <label style="margin-left:5px;" for="savepwd">Enregistrer</label><input id="savepwd" name="savepwd" type="checkbox" />
                        </form>
                    </span>
                    <span style="position:absolute;right:20;top:25;">
                        <a class="menuLien" style="margin-left:5px;" href="lostpwd">Mot de passe oublie</a>
                        <a class="menuLien" style="margin:0;" href="subscribe">S'inscrire !</a>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="site">
            <div class="menu">
                <a class="menuLien" <?php echo ($this->page == 'plan') ? 'style="color:white;"' : ''; ?> href="plan">Plans</a>
                <a class="menuLien" <?php echo ($this->page == 'member') ? 'style="color:white;"' : ''; ?> href="user">Membres</a>
                <a class="menuLien" <?php echo ($this->page == 'crew') ? 'style="color:white;"' : ''; ?> href="crew">Crews</a>
                <a class="menuLien" <?php echo ($this->page == 'appart') ? 'style="color:white;"' : ''; ?> href="appart">Apparts</a>
                <?php if($this->context->get('role_id') == AUTH_LEVEL_SUPERADMIN) : ?>
                    <a class="menuLien" <?php echo ($this->page == 'admin') ? 'style="color:white;"' : ''; ?> href="admin">Admin</a></td>
                <?php endif; ?>
            </div>
            <div style="margin-left: -1px;min-height: 550px;">
                <?php include($this->getViewFileName()); ?>
            </div>
        </div>
        <div class="footer">
            Réalisé par Antoine Ricci - aricci95@gmail.com
        </div>
    </body>
</html>
