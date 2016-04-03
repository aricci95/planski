<?php if($this->value !== null) : ?>
    <tr style="height:40px;">
        <td>
            <b><?php echo ucfirst($this->libel); ?> :</b>
        </td>
        <td style="position: absolute;">
            <?php for ($i = 1; $i <= (int) $this->value; $i++) : ?>
                <img src="/planski/images/icones/<?php echo $this->attribute; ?>.png" />
            <?php endfor; ?>
        </td>
    </tr>
<?php endif; ?>