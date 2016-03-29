<div class="grey" style="height:270px;margin:10px;width:98%;display:inline-block;">
    <h1>
        <?php echo ucfirst($this->crew['crew_name']); ?>
    </h1>
    <div style="text-align: center;display:inline-block;margin-top: -38px;">
        <?php foreach ($this->crew['users'] as $user) : ?>
            <?php $this->render('user/wSmall', array('user' => $user)); ?>
        <?php endforeach; ?>
        <div class="smallProfilePortrait shade" style="float:left;background-image:url(planski/images/icones/join_us.png);">
            <div class="smallProfileLogin gold">Join this crew !</div>
        </div>
    </div>
</div>
