<?php if (!empty($this->elements)) : ?>
    <div style="margin-left: 5%;margin-right: 5%;">
        <?php foreach($this->elements as $element) :
            $this->render($this->type . '/wItem', array($this->type => $element));
        endforeach; ?>
    </div>
<?php endif; ?>