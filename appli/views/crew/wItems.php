<?php if (!empty($this->elements)) : ?>
    <div style="overflow: auto;">
        <?php foreach($this->elements as $element) :
            $this->render('crew/wItem', array('crew' => $element));
        endforeach; ?>
    </div>
<?php endif; ?>