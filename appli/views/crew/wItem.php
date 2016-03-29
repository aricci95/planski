<script>
$(function() {
    $('.test-popup-link').magnificPopup({
      items: [
      <?php foreach($this->photos as $photo) : ?>
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
<div style="margin:10px;text-align: left;">
    <div class="grey" style="height: 400px;">
        <?php $photo = empty($this->user['user_photo_url']) ? 'unknowUser.jpg' : $this->user['user_photo_url']; ?>
        <a class="test-popup-link" href="planski/photos/profile/<?php echo $photo; ?>">
            <div class="profilePortrait" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);"></div>
        </a>
        <div style="margin-left:346px;position: absolute;">
            <div style="color:rgb(35, 31, 32);font-size: 35px;letter-spacing:-2px;font-weight: bold;">
                <?php echo strtoupper($this->user['user_login']); ?>
            </div>
            <br/>
            <?php echo Tools::status($this->user['user_last_connexion']); ?>
            <br/>
            <?php if (isset($this->user['age']) && $this->user['age'] < 2000) : ?>
                <b><?php echo $this->user['age'] . ' ans'; ?></b><?php if (!empty($this->user['ville_nom_reel'])) : echo ', ' . $this->user['ville_nom_reel'] . ' (' . $this->user['ville_code_postal'] . ')'; endif; ?>
                <br/>
            <?php endif; ?>
            Dernière connexion <?php echo Tools::timeConvert($this->user['user_last_connexion']); ?>
            <br/>
            <br/>
            <table class="tableProfil" width="250">
                <?php if (!empty($this->user['user_profession'])) : ?>
                    <tr>
                        <th>Profession</th>
                        <td><?php echo ucfirst($this->user['user_profession']); ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php if(!empty($this->user['user_description'])) : ?>
        <?php echo nl2br(stripcslashes($this->user['user_description'])); ?>
        <div style="height:25px"></div>
    <?php endif; ?>
</div>