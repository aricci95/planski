<ul class="menuLine" style="list-style-type:none;margin-right: 20px;">
    <li style="margin-top:10px;display:inline-block;">
        <a href="mailbox">
            <img src="planski/images/icones/alert.png" />
        </a>
    </li>
    <?php if (!empty(true || $this->context->get('new_notification'))) : ?>
        <li class="counter" style="margin-bottom: 30px;margin-left: -10px;">
            2<?php echo $this->context->get('new_notification'); ?>
        </li>
    <?php endif; ?>
    <li style="margin-left: 5px;display: inline-block;">
        <a href="mailbox">
            <img src="planski/images/icones/message.png" />
        </a>
    </li>
    <?php if (true || !empty($this->context->get('new_messages'))) : ?>
        <li class="counter" style="margin-bottom: 30px;margin-left: -10px;">
            <?php echo $this->context->get('new_messages'); ?>
        </li>
    <?php endif; ?>
    <li style="margin-left:5px;display: inline-block;">
        <?php $photo = empty($this->context->get('user_photo_url')) ? 'unknown.png' : $this->context->get('user_photo_url'); ?>
        <img  class="connectedPhoto" src="planski/photos/profile/<?php echo $photo; ?>" />
    </li>
    <li>
        <ul id="cbp-tm-menu" class="cbp-tm-menu" style="position:relative;margin-top:-48px;margin-left:90px;">
            <li>
                <a href="#" style="font-size: 25px;">
                    <?php echo $this->context->get('user_prenom'); ?>
                    <i class="caret" aria-hidden="true"></i>
                </a>
                <ul class="cbp-tm-submenu">
                    <li><a href="profile/edit" class="cbp-tm-icon-cog">Editer le profil</a></li>
                    <li><a href="plan/feed/1" class="cbp-tm-icon-users">Mes plans</a></li>
                    <li><a href="auth/disconnect" class="cbp-tm-icon-contract">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<script src="planski/libraries/tooltipmenu/js/cbpTooltipMenu.min.js"></script>
<script>
    var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );
</script>
