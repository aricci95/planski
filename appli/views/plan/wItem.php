<div class="grey" style="height:280px;width:98%;">
    <h1>
        <?php echo ucfirst($this->plan['crew_name']); ?>
    </h1>
    <div style="float:left;display:inline-block;margin-top: -38px;">
        <?php foreach ($this->plan['users'] as $user) : ?>
            <?php $this->render('user/wSmall', array('user' => $user)); ?>
        <?php endforeach; ?>
    </div>
    <div style="float:left;">
        <img src="/planski/images/icones/arrow.png" style="float:left;" />
        <?php foreach ($this->plan['apparts'] as $appart) : ?>
            <?php $this->render('appart/wSmall', array('appart' => $appart)); ?>
        <?php endforeach;?>
    </div>
</div>
