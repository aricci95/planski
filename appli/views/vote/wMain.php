<table class="comments" style="padding:10px;">
    <tr>
        <td colspan="2" style="text-align: center;">
            Notez <b><?php echo $this->user['user_login']; ?></b> !
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <textarea cols="70" rows="5"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;height:50px;">
            <input type="submit" />
        </td>
    </tr>
    <?php $color = 'grey'; ?>
    <?php foreach ($this->votes as $vote) :?>
        <tr class="<?php echo $color ?>" style="height:250px;">
            <td width="200" style="text-align: center;"><?php $this->render('user/wSmall', array('user' => $vote)); ?></td>
            <td style="font-size: 20px;">
                <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                    <?php if ($vote['rate'] >= $i) : ?>
                        <img src="/planski/images/icones/star.png" style="width:20px;" />
                    <?php else : ?>
                        <img src="/planski/images/icones/star_off.png" style="width:20px;" />
                    <?php endif; ?>
                <?php endfor; ?>
                <i>" <?php echo ucfirst($vote['comment']);?>"</i>
            </td>
        </tr>
        <?php $color = ($color == 'grey') ?  '' : 'grey'; ?>
    <?php endforeach; ?>
</table>