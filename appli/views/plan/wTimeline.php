<div id="timeline">
    <ul id="dates" style="width: 1000px; margin-left: 350px;">
        <?php foreach($this->steps as $step) : ?>
            <li style="background:url(/planski/images/steps/<?php echo  $step['step_id']; ?>.png) center no-repeat;background-size: 50px 50px;">
                <a href="#<?php echo $step['step_id']; ?>" <?php echo ( $step['step_id'] == $this->step) ? 'class="selected"' : ''; ?>>
                    <?php echo ucfirst($step['step_title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <ul id="issues" style="width: 8000px; margin-left: 0px;">
        <?php foreach($this->steps as $step) : ?>
            <li id="<?php echo  $step['step_id']; ?>" class="selected" style="opacity: 1;">
                <img src="planski/images/steps/<?php echo  $step['step_id']; ?>.png" width="210">
                <h1><?php echo ucfirst($step['step_title']); ?></h1>
                <p style="text-align:justify;"><?php echo nl2br(ucfirst($step['step_description'])); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="#" id="next">+</a>
    <a href="#" id="prev" style="display: none;">-</a>
</div>