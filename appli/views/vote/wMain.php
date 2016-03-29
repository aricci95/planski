<table>
    <?php foreach ($this->votes as $vote) :?>
        <tr class="grey">
            <td><?php $this->render('user/wSmall', array('user' => $vote)); ?></td>
            <td><?php echo $vote['rate'];?></td>
            <td><?php echo $vote['comment'];?></td>
        </tr>
    <?php endforeach; ?>
</table>