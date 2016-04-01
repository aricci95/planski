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
                <div style="float:left;">
                    <a href="plan">
                        <img src="planski/images/structure/planski.png" style="margin-top: 25px;" />
                    </a>
                </div>
                <div>
                    <?php if($this->context->get('user_id')) : ?>
                        <?php $this->render('main/wUserMenu'); ?>
                    <?php else : ?>
                        <?php $this->render('main/wLogin'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="site">
            <?php $this->render('main/wMenu'); ?>
            <div style="margin-left: -1px;min-height: 550px;">
                <?php include($this->getViewFileName()); ?>
            </div>
        </div>
        <div class="footer">
            Réalisé par Antoine Ricci - aricci95@gmail.com
        </div>
    </body>
</html>
