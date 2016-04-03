<div style="margin: 0 auto;width: 942px;">
    <div id="comments-container" style="text-align: left;"></div>
        <div style="display:inline-block;margin-top: -38px;">
            <?php foreach ($this->plan['users'] as $user) : ?>
                <?php $this->render('user/wSmall', array('user' => $user)); ?>
            <?php endforeach; ?>
        </div>
    <?php if (!empty($this->plan['apparts'][0]['photos'])) : ?>
        <script>
            $(function() {
                $('#popup_<?php echo $this->plan['apparts'][0]["appart_id"]; ?>').magnificPopup({
                  items: [
                  <?php foreach($this->plan['apparts'][0]['photos'] as $photo) : ?>
                      <?php echo " {
                        src: 'planski/photos/appart/" . $this->plan['apparts'][0]["appart_id"] . '/' . $photo['photo_url'] . "'
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
        <h3>APPART</h3>
        <div id="popup_<?php echo $this->plan['apparts'][0]['appart_id']; ?>" class="profilePortrait shade" style="margin-top:90px;float:left;background-image:url(planski/photos/appart/<?php echo $photo; ?>);"></div>
        <div class="appartLibel" style="margin-top:360px;">
            <?php echo ucfirst($this->plan['apparts'][0]['appart_libel']); ?>
            <div class="popup" href="vote/<?php echo Vote::TYPE_APPART . '/' . $this->plan['apparts'][0]['appart_id']; ?>" style="margin-top:30px;">
                <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                    <?php if (!empty($this->plan['apparts'][0]['rate']) && $this->plan['apparts'][0]['rate'] >= $i) : ?>
                        <img src="/planski/images/icones/star.png" />
                    <?php else : ?>
                        <img src="/planski/images/icones/star_off.png"/>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <?php $this->render('appart/wDetail', array('appart' => $this->plan['apparts'][0])); ?>
    </div>
</div>