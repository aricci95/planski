<div class="crew grey" style="height:270px;margin:10px;width:98%;display:inline-block;">
    <h1>
        <?php echo ucfirst($this->crew['crew_name']); ?>
    </h1>
    <div style="display:inline-block;margin-top: -38px;">
        <?php foreach ($this->crew['users'] as $user) : ?>
            <?php $this->render('user/wSmall', array('user' => $user)); ?>
        <?php endforeach; ?>
    </div>
    <a href="crew/join/<?php echo $this->crew['crew_id']; ?>">
        <div class="smallProfilePortrait shade join" style="opacity:0.5;display:none;float:right;margin-top:-17px;margin-right:25px;background-image:url(planski/images/icones/joinus2.png);">
            <div class="smallProfileLogin">Rejoindre !</div>
        </div>
    </a>
</div>
