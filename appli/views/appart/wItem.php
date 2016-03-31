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
    <?php $this->render('appart/wDetail', array('appart' => $this->appart)); ?>
</div>