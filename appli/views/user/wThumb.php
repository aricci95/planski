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
    <?php if (!empty($this->user['user_ride'])) : ?>
        <img src="/planski/images/icones/<?php echo User::$rides[$this->user['user_ride']]; ?>.png" style="padding: 3px;left: 0px;position: absolute;width: 37px;" />
    <?php endif; ?>
    <?php if (isset($this->user['user_level'])) : ?>
      <img src="/planski/images/medals/<?php echo $this->user['user_level'] . '.png'; ?>" style="position: absolute;right: 0;padding: 1px;width: 49px;" />
    <?php endif; ?>
</div>
