<a href="mailbox" style="position:absolute;right:16%;top: 32px;">
    <img src="planski/images/icones/message.png" />
</a>
<a href="mailbox" style="position:absolute;right:19%;top: 29px;">
    <img src="planski/images/icones/alert.png" />
</a>
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
