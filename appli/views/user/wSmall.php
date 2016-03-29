<?php $photo = empty($this->user['user_photo_url']) ? 'unknowUser.jpg' : $this->user['user_photo_url']; ?>
<div class="smallProfilePortrait shade" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);"></div>
<div class="smallProfileLogin gold">
    <?php echo strtoupper($this->user['user_login']); ?>
</div>
