  <script>
      $(function() {
          $('#popup_<?php echo $this->user["user_id"]; ?>').magnificPopup({
            items: [
                <?php echo " {
                  src: 'planski/photos/profile/" . $this->user['user_photo_url'] . "'
                }, ";
                ?>
          ],
          gallery: {
            enabled: true
          },
          type: 'image'
          });
      });
  </script>
<?php $photo = empty($this->user['user_photo_url']) ? 'unknown.png' : $this->user['user_photo_url']; ?>
<div id="popup_<?php echo $this->user['user_id']; ?>" class="profilePortrait shade" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);"></div>
<div class="profileLogin">
    <?php echo strtoupper($this->user['user_prenom']); ?><?php echo Tools::status($this->user['user_last_connexion']); ?>
    <div class="popup" href="vote/<?php echo Vote::TYPE_USER . '/' . $this->user['user_id']; ?>" style="margin-top: 10px;">
        <?php for ($i= 1 ; $i <= 4; $i++) : ?>
            <?php if (isset($this->user['rate']) && $this->user['rate'] >= $i) : ?>
                <img src="/planski/images/icones/star.png" />
            <?php else : ?>
                <img src="/planski/images/icones/star_off.png"/>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    <?php if (!empty($this->user['user_ride'])) : ?>
        <img src="/planski/images/icones/<?php echo User::$rides[$this->user['user_ride']]; ?>.png" style="left: 0px;position: absolute;top: 47px;" />
    <?php endif; ?>
    <img src="/planski/images/medals/<?php echo $this->user['user_level'] . '.png'; ?>" style="position: absolute;top:46px;right:0px;" />
</div>
