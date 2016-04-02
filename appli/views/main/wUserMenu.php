<div style="float:right;margin-right: 85px;">
    <ul class="menuLine" style="list-style-type:none;">
        <li style="margin-top:10px;">
            <a href="mailbox">
                <img src="planski/images/icones/alert.png" />
            </a>
        </li>
        <?php if (!empty($this->context->get('new_notification'))) : ?>
            <li class="counter" style="margin-bottom: 30px;margin-left: -10px;">
                2<?php echo $this->context->get('new_notification'); ?>
            </li>
        <?php endif; ?>
        <li style="margin-left: 5px;">
            <a href="mailbox">
                <img src="planski/images/icones/message.png" />
            </a>
        </li>
        <?php if (!empty($this->context->get('new_messages'))) : ?>
            <li class="counter" style="margin-bottom: 30px;margin-left: -10px;">
                <?php echo $this->context->get('new_messages'); ?>
            </li>
        <?php endif; ?>
        <li style="margin-left:5px;width:38px;">
            <?php $photo = empty($this->context->get('user_photo_url')) ? 'unknown.png' : $this->context->get('user_photo_url'); ?>
            <img  class="connectedPhoto" src="planski/photos/profile/<?php echo $photo; ?>" />
        </li>
        <li>
            <a class="dropdown" href="#" style="position:absolute;top:30px;">
                <?php echo $this->context->get('user_prenom'); ?>
                <i class="caret" aria-hidden="true"></i>
            </a>
            <img class="onglet" style="" src="planski/images/icones/onglet.png" />
        </li>
    </ul>
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
</div>