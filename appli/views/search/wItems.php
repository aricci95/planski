<?php if (!empty($this->elements)) : ?>
    <div style="margin: 0 auto;width: 1008px;">
        <?php foreach($this->elements as $element) :
            $this->render($this->type . '/wItem', array($this->type => $element));
        endforeach; ?>
    </div>
<?php endif; ?>