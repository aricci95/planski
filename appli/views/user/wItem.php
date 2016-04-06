<div class="grey" style="min-height: 400px;text-align: left;padding: 10px;margin:10px;">
    <?php $this->render('user/wThumb', array('user' => $this->user)); ?>
    <p>
        Dernière connexion <?php echo Tools::timeConvert($this->user['user_last_connexion']); ?>
    </p>
    <p>
        <?php if (isset($this->user['age']) && $this->user['age'] < 2000) : ?>
            <b><?php echo $this->user['age'] . ' ans'; ?></b>
            <?php echo (!empty($this->user['ville_nom_reel'])) ?  ', ' . $this->user['ville_nom_reel'] . ' (' . $this->user['ville_code_postal'] . ')' : ''; ?>
        <?php endif; ?>
    </p>
    <p>
        <?php if(!empty($this->user['user_description'])) : ?>
                <?php echo nl2br(stripcslashes($this->user['user_description'])); ?>
        <?php endif; ?>
    </p>
    <table style="width:350px;">
        <?php if (!empty($this->user['user_profession'])) : ?>
             <tr style="height:35px;">
                <td width="90"><b>Profession :</b></td>
                <td><?php echo ucfirst($this->user['user_profession']); ?></td>
            </tr>
        <?php endif; ?>
        <tr style="height:40px;">
            <td>
                <b>Avis :</b>
            </td>
            <td style="position: absolute;">
                <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                    <?php if (!empty($this->user['user_rate']) && $this->user['user_rate'] >= $i) : ?>
                        <img src="/planski/images/icones/star.png" />
                    <?php else : ?>
                        <img src="/planski/images/icones/star_off.png"/>
                    <?php endif; ?>
                <?php endfor; ?>
            </td>
        </tr>
        <?php
            foreach (User::$evals as $key => $value) {
                $this->render('modules/wEval', array(
                    'libel' => $key,
                    'attribute' => $value,
                    'value' => $this->user['user_' . $value]
                ));
            }
        ?>

        <?php if (!empty($this->user['user_vehicule'])) : ?>
            <tr style="height:35px;">
                <td>
                    <b>Véhicule :</b>
                </td>
                <td><?php echo ucfirst($this->user['user_vehicule']); ?> places</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
