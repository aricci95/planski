<?php if (!empty($this->user['photos'])) : ?>
    <script>
        $(function() {
            $('#popup_<?php echo $this->user["user_id"]; ?>').magnificPopup({
              items: [
              <?php foreach($this->user['photos'] as $photo) : ?>
                  <?php echo " {
                    src: 'planski/photos/profile/" . $photo['photo_url'] . "'
                  }, ";
                  ?>
              <?php endforeach; ?>
            ],
            gallery: {
              enabled: true
            },
            type: 'image'
            });
        });
    </script>
<?php endif ;?>
<?php $photo = empty($this->user['user_photo_url']) ? 'unknowUser.jpg' : $this->user['user_photo_url']; ?>
<div id="popup_<?php echo $this->user['user_id']; ?>" class="profilePortrait shade" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);"></div>
<div class="profileLogin gold">
    <?php echo strtoupper($this->user['user_login']); ?>
    <div class="popup" href="vote/<?php echo Vote::TYPE_USER . '/' . $this->user['user_id']; ?>" style="margin-top: 10px;">
        <?php for ($i= 1 ; $i <= 4; $i++) : ?>
            <?php if ($this->user['rate'] >= $i) : ?>
                <img src="/planski/images/icones/star.png" />
            <?php else : ?>
                <img src="/planski/images/icones/star_off.png"/>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    <?php if (!empty($this->user['user_ride'])) : ?>
        <img src="/planski/images/icones/<?php echo User::$rides[$this->user['user_ride']]; ?>.png" style="left: -20px;position: absolute;top: -13px;" />
    <?php endif; ?>
    <?php if (!empty($this->user['user_level'])) : ?>
            <img src="/planski/images/icones/<?php echo User::$medals[$this->user['user_level']]; ?>.png" style="position: absolute;top: -4px;right: -21px;" />
    <?php endif; ?>
</div>
