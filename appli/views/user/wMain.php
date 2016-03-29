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
<div style="background-color:rgb(247, 247, 248);">
    <div class="heading topShadow" style="height: 31px;padding:25px;">
        <div style="float: left;padding-top: 5px;">
            CONTENT
        </div>
        <div style="float: right;">
            <a style="padding-left:50px;" href="message/<?php echo $this->user['user_id']; ?>">
                <img src="planski/images/boutons/big_email.jpg" title="envoyer un message" />
            </a>
        </div>
    </div>
</div>
<div style="margin:25px;text-align: left;width: 775px;">
    <div class="grey" style="height: 294px;margin-left: -25px;margin-top: -25px;">
        <?php $photo = empty($this->user['user_photo_url']) ? 'unknowUser.jpg' : $this->user['user_photo_url']; ?>
        <a class="test-popup-link" href="planski/photos/profile/<?php echo $photo; ?>">
            <div class="profilePortrait" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);">
                <?php if ($this->context->get('user_id') == $this->user['user_id']) : ?>
                    <a style="position:absolute;margin-top: 8px;margin-left: 11px;" href="photo/<?php echo PHOTO_TYPE_USER; ?>" title="Modifier les photos"><img src="planski/images/icones/photo.png" /></a>
                <?php endif; ?>
            </div>
        </a>
        <div class="shadow"></div>
        <div style="padding-left:10px;padding-right:10px;">
            <div style="color:rgb(35, 31, 32);font-size: 35px;letter-spacing:-2px;font-weight: bold;width:100%;">
                <?php echo strtoupper($this->user['user_login']); ?> <?php $this->_helper->showStatut($this->user['user_last_connexion'], true); ?>
                <?php if ($this->context->get('user_id') == $this->user['user_id']) : ?>
                    <span style="float:right;">
                        <a href="profile/edit" title="Editer"><img src="planski/images/icones/edit.png" /></a>
                    </span>
                <?php endif; ?>
            </div>
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
                <tr>
                    <th>Mensurations</th>
                    <td><?php if ($this->user['user_taille'] > 0)
                    echo $this->user['user_taille'] . ' cm';
                if ($this->user['user_poids'] > 0)
                    echo ', ' . $this->user['user_poids'] . ' kg';
                ?>
                    </td>
                </tr>
                <?php if (!empty($this->details['tattoo'])) : ?>
                    <tr>
                        <th>Tatouages</th>
                    <td><?php echo $this->details['tattoo']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if (!empty($this->details['piercing'])) : ?>
                    <tr>
                        <th>Piercings</th>
                        <td><?php echo $this->details['piercing']; ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php if(!empty($this->user['user_description'])) : ?>
        <div class="title noMargin">DESCRIPTION</div>
        <div class="shadow noMargin"></div>
        <?php echo nl2br(stripcslashes($this->user['user_description'])); ?>
        <div style="height:25px"></div>
    <?php endif; ?>
</div>
