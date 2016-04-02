<div style="margin:10px;text-align: left;">
    <div class="grey" style="min-height: 400px;">
        <?php $this->render('user/wThumb', array('user' => $this->user)); ?>
        <div style="margin-left: 336px;margin-top: -300px;display: inline-block;width: 81%;">
            <div style="float:left;">
                <p>
                    Dernière connexion <?php echo Tools::timeConvert($this->user['user_last_connexion']); ?>
                </p>
                <p>
                    <?php if (isset($this->user['age']) && $this->user['age'] < 2000) : ?>
                        <b><?php echo $this->user['age'] . ' ans'; ?></b>
                        <?php echo (!empty($this->user['ville_nom_reel'])) ?  ', ' . $this->user['ville_nom_reel'] . ' (' . $this->user['ville_code_postal'] . ')' : ''; ?>
                    <?php endif; ?>
                </p>
                <p style="width:83%;">
                    <?php if(!empty($this->user['user_description'])) : ?>
                            <?php echo nl2br(stripcslashes($this->user['user_description'])); ?>
                    <?php endif; ?>
                </p>
                <table style="width:350px;">
                    <tr>
                        <td><b>Avis :</b></td>
                        <td>
                            <div class="popup" href="vote/<?php echo Vote::TYPE_USER . '/' . $this->user['user_id']; ?>" style="margin-top: 10px;">
                                <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                                    <?php if (isset($this->user['rate']) && $this->user['rate'] >= $i) : ?>
                                        <img src="/planski/images/icones/star.png" />
                                    <?php else : ?>
                                        <img src="/planski/images/icones/star_off.png"/>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </td>
                    </tr>
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

                    <?php if(!empty($this->user['user_cash'])) : ?>
                        <tr style="height:35px;">
                            <td><b>Dépenses :</b></td>
                            <td style="position: absolute;">
                                <?php for ($i = 1; $i <= (int) $this->user['user_cash']; $i++) : ?>
                                    <img src="/planski/images/icones/cash.png" style="margin-right:7px;" />
                                <?php endfor; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>