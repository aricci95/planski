<div class="title topShadow" style="font-size: 20px;"><?php echo ucfirst($this->destinataire['user_prenom']); ?></div>
<?php $this->render('message/wNew'); ?>
<?php if(!empty($this->parentMessages)) : ?>
    <table class="results" cellspacing="0" align="center" style="width:80%;">
        <?php $this->render('message/wItems'); ?>
        <tr>
            <td>
                <img class="loading" src="planski/images/icones/loading.gif" data-end="false" style="display:none;" data-show="false" data-offset="0" data-href="message" data-option="<?php echo $this->destinataire['user_id']; ?>" />
            </td>
        </tr>
    </table>
<?php endif;?>
