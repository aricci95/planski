<?php if (!empty($this->appart['photos'])) : ?>
    <script>
        $(function() {
            $('#popup_<?php echo $this->appart["appart_id"]; ?>').magnificPopup({
              items: [
              <?php foreach($this->appart['photos'] as $photo) : ?>
                  <?php echo " {
                    src: 'planski/photos/appart/" . $this->appart["appart_id"] . '/' . $photo['photo_url'] . "'
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
<?php $photo = '1/1.jpg'; ?>
<div class="grey" style="height: 500px;margin:10px;width:98%;display:inline-block;">
    <div id="popup_<?php echo $this->appart['appart_id']; ?>" class="profilePortrait shade" style="float:left;background-image:url(planski/photos/appart/<?php echo $photo; ?>);"></div>
    <div class="appartLibel">
        <?php echo ucfirst($this->appart['appart_libel']); ?>
        <div class="popup" href="vote/<?php echo Vote::TYPE_APPART . '/' . $this->appart['appart_id']; ?>" style="margin-top:30px;">
            <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                <?php if (!empty($this->appart['rate']) && $this->appart['rate'] >= $i) : ?>
                    <img src="/planski/images/icones/star.png" />
                <?php else : ?>
                    <img src="/planski/images/icones/star_off.png"/>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div style="margin-left: 350px;margin-top: 20px;position: absolute;width:70%;text-align: left;">
        <p>
            <?php if(!empty($this->appart['appart_description'])) : ?>
                <?php echo nl2br($this->appart['appart_description']); ?>
            <?php endif; ?>
        </p>
        <table style="width:350px;">
            <?php if (!empty($this->appart['appart_size'])) : ?>
                 <tr style="height:35px;">
                    <td width="120"><b>Taille :</b></td>
                    <td><?php echo $this->appart['appart_size']; ?> m²</td>
                </tr>
            <?php endif; ?>

            <?php if (!empty($this->appart['appart_users'])) : ?>
                <tr style="height:35px;">
                    <td>
                        <b>Personnes max :</b>
                    </td>
                    <td><?php echo $this->appart['appart_users']; ?></td>
                </tr>
            <?php endif; ?>

            <?php if (!empty($this->appart['appart_room'])) : ?>
                <tr style="height:35px;">
                    <td>
                        <b>Chambre(s) :</b>
                    </td>
                    <td><?php echo $this->appart['appart_room']; ?></td>
                </tr>
            <?php endif; ?>

            <?php if (!empty($this->appart['appart_bath'])) : ?>
                <tr style="height:35px;">
                    <td>
                        <b>Salle(s) de bain :</b>
                    </td>
                    <td><?php echo $this->appart['appart_bath']; ?></td>
                </tr>
            <?php endif; ?>

            <?php if(!empty($this->appart['appart_cuisine'])) : ?>
                <tr style="height:35px;">
                    <td><b>Cuisine :</b></td>
                    <td style="position: absolute;">
                        <?php for ($i = 1; $i <= (int) $this->appart['appart_cuisine']; $i++) : ?>
                            <img src="/planski/images/icones/food.png" />
                        <?php endfor; ?>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if(!empty($this->appart['appart_fun'])) : ?>
                <tr style="height:35px;">
                    <td>
                        <b>Fun :</b>
                    </td>
                    <td style="">
                        <?php for ($i = 1; $i <= (int) $this->appart['appart_fun']; $i++) : ?>
                            <img src="/planski/images/icones/fun.png" style="margin-right:10px;" />
                        <?php endfor; ?>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if(!empty($this->appart['appart_hygiene'])) : ?>
                <tr style="height:35px;">
                    <td><b>Hygiène :</b></td>
                    <td style="position: absolute;">
                        <?php for ($i = 1; $i <= (int) $this->appart['appart_hygiene']; $i++) : ?>
                            <img src="/planski/images/icones/hygiene.png" style="margin-right:10px;" />
                        <?php endfor; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>