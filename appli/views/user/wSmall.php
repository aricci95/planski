<?php $photo = empty($this->user['user_photo_url']) ? 'unknowUser.jpg' : $this->user['user_photo_url']; ?>
<div class="smallProfilePortrait shade" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);">
    <div class="smallProfileLogin">
        <?php echo strtoupper($this->user['user_login']); ?><?php echo Tools::status($this->user['user_last_connexion']); ?>
    </div>
    <div class="popup" href="vote/<?php echo Vote::TYPE_USER . '/' . $this->user['user_id']; ?>" style="margin-top: 166px;">
        <?php for ($i= 1 ; $i <= 4; $i++) : ?>
            <?php if ($this->user['rate'] >= $i) : ?>
                <img src="/planski/images/icones/star.png" style="width:20px;" />
            <?php else : ?>
                <img src="/planski/images/icones/star_off.png" style="width:20px;" />
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    <?php if (!empty($this->user['user_ride'])) : ?>
        <img src="/planski/images/icones/<?php echo User::$rides[$this->user['user_ride']]; ?>.png" style="width: 30px;left: -3px;position: absolute;top: 164px;" />
    <?php endif; ?>
    <?php if (!empty($this->user['user_level'])) : ?>
            <img src="/planski/images/medals/<?php echo $this->user['user_level']; ?>.png" style="width: 35px;position: absolute;right: -6px;top: 163px;" />
    <?php endif; ?>
</div>
