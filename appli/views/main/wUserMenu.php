<div style="float:right;display:inline-block;">
<div style="float:right;">
        <img class="onglet" style="" src="planski/images/icones/onglet.png" />
        <a style="float:right;" class="dropdown" href="#">
            <?php echo $this->context->get('user_prenom'); ?><i class="caret" aria-hidden="true"></i>
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
        <?php $photo = empty($this->context->get('user_photo_url')) ? 'unknown.png' : $this->context->get('user_photo_url'); ?>
        <img style="float:right;" class="connectedPhoto" src="planski/photos/profile/<?php echo $photo; ?>" />
    </div>
    <div style="float:right;">
        <a href="mailbox" style="float:right;">
            <img src="planski/images/icones/message.png" />
        </a>
        <?php if (true || !empty($this->context->get('new_messages'))) : ?>
            <div class="counter" style="float:right;"><?php echo $this->context->get('new_messages'); ?></div>
        <?php endif; ?>
        <a href="mailbox" style="float:right;">
            <img src="planski/images/icones/alert.png" />
        </a>
        <?php if (true || !empty($this->context->get('new_notification'))) : ?>
            <div class="counter" style=""><?php echo $this->context->get('new_notification'); ?></div>
        <?php endif; ?>
    </div>

</div>