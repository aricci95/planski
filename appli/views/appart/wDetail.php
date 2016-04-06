<div style="margin-left: 350px;margin-top: 20px;position: absolute;width:66%;text-align: left;">
    <p style="width:600px;text-align: justify;">
        <?php if(!empty($this->appart['appart_description'])) : ?>
            <?php echo nl2br($this->appart['appart_description']); ?>
        <?php endif; ?>
    </p>
    <table style="width:350px;">
        <?php if (!empty($this->appart['appart_size'])) : ?>
             <tr style="height:35px;">
                <td width="120"><b>Taille :</b></td>
                <td><?php echo $this->appart['appart_size']; ?> m²</td>
            </tr>
        <?php endif; ?>

        <?php if (!empty($this->appart['appart_users'])) : ?>
            <tr style="height:35px;">
                <td>
                    <b>Personnes max :</b>
                </td>
                <td><?php echo $this->appart['appart_users']; ?></td>
            </tr>
        <?php endif; ?>

        <?php if (!empty($this->appart['appart_room'])) : ?>
            <tr style="height:35px;">
                <td>
                    <b>Chambre(s) :</b>
                </td>
                <td><?php echo $this->appart['appart_room']; ?></td>
            </tr>
        <?php endif; ?>

        <?php if (!empty($this->appart['appart_bath'])) : ?>
            <tr style="height:35px;">
                <td>
                    <b>Salle(s) de bain :</b>
                </td>
                <td><?php echo $this->appart['appart_bath']; ?></td>
            </tr>
        <?php endif; ?>

        <?php if(!empty($this->appart['appart_cuisine'])) : ?>
            <tr style="height:35px;">
                <td><b>Cuisine :</b></td>
                <td style="position: absolute;">
                    <?php for ($i = 1; $i <= (int) $this->appart['appart_cuisine']; $i++) : ?>
                        <img src="/planski/images/icones/food.png" />
                    <?php endfor; ?>
                </td>
            </tr>
        <?php endif; ?>

        <?php if(!empty($this->appart['appart_fun'])) : ?>
            <tr style="height:35px;">
                <td>
                    <b>Fun :</b>
                </td>
                <td style="">
                    <?php for ($i = 1; $i <= (int) $this->appart['appart_fun']; $i++) : ?>
                        <img src="/planski/images/icones/fun.png" style="margin-right:10px;" />
                    <?php endfor; ?>
                </td>
            </tr>
        <?php endif; ?>

        <?php if(!empty($this->appart['appart_hygiene'])) : ?>
            <tr style="height:35px;">
                <td><b>Hygiène :</b></td>
                <td style="position: absolute;">
                    <?php for ($i = 1; $i <= (int) $this->appart['appart_hygiene']; $i++) : ?>
                        <img src="/planski/images/icones/hygiene.png" style="margin-right:10px;" />
                    <?php endfor; ?>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>