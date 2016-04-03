<?php $photo = empty($this->user['user_photo_url']) ? 'unknown.png' : $this->user['user_photo_url']; ?>
<div class="popup smallProfilePortrait shade" href="profile/<?php echo $this->user['user_id']; ?>" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);" style="margin-right: -100px;">
    <div class="smallProfileLogin">
        <?php echo strtoupper($this->user['user_prenom']); ?><?php echo Tools::status($this->user['user_last_connexion']); ?>
    </div>
</div>
