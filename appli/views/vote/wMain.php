<table>
    <?php foreach ($this->votes as $vote) :?>
        <tr>
            <td><b><?php echo $vote['user_login'];?></b></td>
            <td><?php echo $vote['rate'];?></td>
            <td><?php echo $vote['comment'];?></td>
        </tr>
    <?php endforeach; ?>
</table>