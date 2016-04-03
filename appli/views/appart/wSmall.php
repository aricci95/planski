<?php $photo = '1/1.jpg'; ?>
<div class="popup smallAppartPortrait shade" href="profile/<?php echo $this->appart['appart_id']; ?>" style="float:left;background-image:url(planski/photos/appart/<?php echo $photo; ?>);">
    <div class="smallAppartLibel">
        <?php echo ucfirst($this->appart['appart_libel']); ?>
    </div>
</div>
