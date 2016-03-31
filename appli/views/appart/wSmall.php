<?php $photo = '1/1.jpg'; ?>
<div class="popup smallAppartPortrait shade" href="profile/<?php echo $this->appart['appart_id']; ?>" style="float:left;background-image:url(planski/photos/appart/<?php echo $photo; ?>);">
    <div class="smallAppartLibel">
        <?php echo ucfirst($this->appart['appart_libel']); ?>
        <div class="popup" href="vote/<?php echo Vote::TYPE_APPART . '/' . $this->appart['appart_id']; ?>" style="margin-top: 13px;margin-left: 10px;">
            <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                <?php if (!empty($this->appart['rate']) && $this->appart['rate'] >= $i) : ?>
                    <img src="/planski/images/icones/star.png" style="width:20px;" />
                <?php else : ?>
                    <img src="/planski/images/icones/star_off.png" style="width:20px;" />
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>
