<script>
$(function() {
    $('.popup').magnificPopup({
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
        <a class="popup" href="planski/photos/profile/<?php echo $photo; ?>">
            <div class="profilePortrait shade" style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);">
                <div class="profileLogin gold">
                    <div style="position:absolute;bottom:-50px;left: 55px;">
                        <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                            <?php if ($this->user['rate'] >= $i) : ?>
                                <img src="/planski/images/icones/star.png" />
                            <?php else : ?>
                                <img src="/planski/images/icones/star_off.png"/>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php if (!empty($this->user['user_ride'])) : ?>
                        <img src="/planski/images/icones/<?php echo User::$rides[$this->user['user_ride']]; ?>.png" style="position:absolute;left:-20px;bottom:-10px;" />
                    <?php endif;
                        echo strtoupper($this->user['user_login']);
                        if (!empty($this->user['user_level'])) : ?>
                            <img src="/planski/images/icones/<?php echo User::$medals[$this->user['user_level']]; ?>.png" style="position:absolute;right:-25px;bottom: -49px;" />
                    <?php endif; ?>
                </div>
            </div>
        </a>
        <div style="margin-left: 362px;margin-top: 20px;position: absolute;">
            <p>
                <?php echo Tools::status($this->user['user_last_connexion']); ?>
                <br/>
                Dernière connexion <?php echo Tools::timeConvert($this->user['user_last_connexion']); ?>
            </p>
            <p>
                <?php if (isset($this->user['age']) && $this->user['age'] < 2000) : ?>
                        <b><?php echo $this->user['age'] . ' ans'; ?></b>
                        <?php echo (!empty($this->user['ville_nom_reel'])) ?  ', ' . $this->user['ville_nom_reel'] . ' (' . $this->user['ville_code_postal'] . ')' : ''; ?>
                <?php endif; ?>
            </p>
            <p>
                <?php if(!empty($this->user['user_description'])) : ?>
                        <?php echo nl2br(stripcslashes($this->user['user_description'])); ?>
                <?php endif; ?>
            </p>
            <table style="width:350px;">
                <?php if (!empty($this->user['user_profession'])) : ?>
                     <tr style="height:35px;">
                        <td width="90"><b>Profession :</b></td>
                        <td><?php echo ucfirst($this->user['user_profession']); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if (!empty($this->user['user_vehicule'])) : ?>
                    <tr style="height:35px;">
                        <td>
                            <b>Véhicule :</b>
                        </td>
                        <td><?php echo ucfirst($this->user['user_vehicule']); ?> places</td>
                    </tr>
                <?php endif; ?>

                <?php if(!empty($this->user['user_cuisine'])) : ?>
                    <tr style="height:35px;">
                        <td><b>Cuisine :</b></td>
                        <td style="position: absolute;">
                            <?php for ($i = 1; $i <= (int) $this->user['user_cuisine']; $i++) : ?>
                                <img src="/planski/images/icones/food.png" />
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php if(!empty($this->user['user_fun'])) : ?>
                    <tr style="height:35px;">
                        <td>
                            <b>Fun :</b>
                        </td>
                        <td style="">
                            <?php for ($i = 1; $i <= (int) $this->user['user_fun']; $i++) : ?>
                                <img src="/planski/images/icones/fun.png" style="margin-right:10px;" />
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php if(!empty($this->user['user_hygiene'])) : ?>
                    <tr style="height:35px;">
                        <td><b>Hygiène :</b></td>
                        <td style="position: absolute;">
                            <?php for ($i = 1; $i <= (int) $this->user['user_hygiene']; $i++) : ?>
                                <img src="/planski/images/icones/hygiene.png" style="margin-right:10px;" />
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>