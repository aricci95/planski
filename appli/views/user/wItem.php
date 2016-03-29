<div style="margin:10px;text-align: left;">
    <div class="grey" style="height: 400px;">
        <?php $this->render('user/wThumb', array('user' => $this->user)); ?>
        <div style="margin-left: 362px;margin-top: 20px;position: absolute;">
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

                <?php if (!empty($this->user['user_vehicule'])) : ?>
                    <tr style="height:35px;">
                        <td>
                            <b>Véhicule :</b>
                        </td>
                        <td><?php echo ucfirst($this->user['user_vehicule']); ?> places</td>
                    </tr>
                <?php endif; ?>

                <?php if(!empty($this->user['user_cuisine'])) : ?>
                    <tr style="height:35px;">
                        <td><b>Cuisine :</b></td>
                        <td style="position: absolute;">
                            <?php for ($i = 1; $i <= (int) $this->user['user_cuisine']; $i++) : ?>
                                <img src="/planski/images/icones/food.png" />
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php if(!empty($this->user['user_fun'])) : ?>
                    <tr style="height:35px;">
                        <td>
                            <b>Fun :</b>
                        </td>
                        <td style="">
                            <?php for ($i = 1; $i <= (int) $this->user['user_fun']; $i++) : ?>
                                <img src="/planski/images/icones/fun.png" style="margin-right:10px;" />
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php if(!empty($this->user['user_hygiene'])) : ?>
                    <tr style="height:35px;">
                        <td><b>Hygiène :</b></td>
                        <td style="position: absolute;">
                            <?php for ($i = 1; $i <= (int) $this->user['user_hygiene']; $i++) : ?>
                                <img src="/planski/images/icones/hygiene.png" style="margin-right:10px;" />
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>