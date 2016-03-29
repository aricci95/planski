<?php if (!empty($this->elements)) : ?>
    <div style="overflow: auto;">
        <?php foreach($this->elements as $element) :
            $this->render($this->type . '/wItem', array($this->type => $element));
        endforeach; ?>
    </div>
<?php endif; ?>