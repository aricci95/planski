<form action="message/submit<?php if(!empty($_GET['value'])) : ?>/<?php echo $_GET['value']; ?><?php endif;?>" method="post">
    <?php if(!empty($this->parentMessages)) : ?>
        <input type="hidden" name="last_content" value="<?php echo $this->parentMessages[0]['content']; ?>" />
    <?php endif; ?>
    <div style="margin: 10px;">
        <input type="hidden" value="<?php echo $this->destinataire['user_id']; ?>" name="destinataire_id" />
        <textarea name="content" cols="95" rows="8"></textarea>
    </div>
    <input type="submit" value="Envoyer" style="width:200px;">
</form>
<div style="margin-bottom: 30px;"></div>
