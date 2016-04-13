<html>
    <head>
        <base href="/" >
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <?php $this->render('main/wJavascript'); ?>
        <?php $this->render('main/wCss'); ?>
        <link rel="icon" type="image/png" href="planski/images/icones/fav.gif" />
        <title>PlanSki</title>
    </head>
    <body>
        <div class="header">
            <div class="userMenu">
                <div class="planski">
                    <a href="<?php echo ($this->context->get('user_id')) ? 'home' : 'subscribe'; ?>">
                        Planski
                    </a>
                </div>
                <?php if($this->context->get('user_id')) : ?>
                    <?php $this->render('main/wUserMenu'); ?>
                <?php else : ?>
                    <?php $this->render('main/wLogin'); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="site">
            <?php $this->render('main/wMenu'); ?>
            <?php $this->render('main/wTitle'); ?>
            <div class="content" align="center">
                <?php include($this->getViewFileName()); ?>
            </div>
        </div>
        <div class="footer">
            Réalisé par Antoine Ricci - aricci95@gmail.com
        </div>
    </body>
</html>