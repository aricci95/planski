<div class="grey" style="text-align: left;min-height: 210px;margin:10px;">
    <table>
        <tr>
            <td>
                <div style="margin-top: -25px;">
                    <?php foreach ($this->crew['users'] as $user) : ?>
                        <?php $photo = empty($user['user_photo_url']) ? 'unknown.png' : $user['user_photo_url']; ?>
                        <div class="popup smallProfilePortrait shade" href="profile/<?php echo $user['user_id']; ?>"
                            style="float:left;background-image:url(planski/photos/profile/<?php echo $photo; ?>);margin-right: -80px;">
                        </div>
                    <?php endforeach; ?>
                    <div class="crewLibel">
                        <?php echo ucfirst($this->crew['crew_name']); ?>
                    </div>
                </div>
            </td>
            <?php if (!empty($this->crew['apparts'])) : ?>
                <td style="padding-left: 80px;">
                    <img src="/planski/images/icones/arrow.png" style="width:120px;z-index:5000;" />
                </td>
                <td>
                    <?php foreach ($this->crew['apparts'] as $appart) : ?>
                        <?php $this->render('appart/wSmall', array('appart' => $appart)); ?>
                    <?php endforeach;?>
                </td>
            <?php else : ?>
                <td style="padding-left: 80px;width:420px;">
                </td>
            <?php endif; ?>
            <td>
                <table style="text-align: left;">
                    <tr style="height:40px;">
                        <td>
                            <b>Avis :</b>
                        </td>
                        <td style="position: absolute;">
                            <?php for ($i= 1 ; $i <= 4; $i++) : ?>
                                <?php if (!empty($this->crew['crew_rate']) && $this->crew['crew_rate'] >= $i) : ?>
                                    <img src="/planski/images/icones/star.png" />
                                <?php else : ?>
                                    <img src="/planski/images/icones/star_off.png"/>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <?php if (!empty($this->crew['crew_level'])) : ?>
                        <tr style="height:60px;">
                            <td>
                                <b>Niveau :</b>
                            </td>
                            <td style="position: absolute;">
                                 <img src="/planski/images/medals/<?php echo round($this->crew['crew_level']); ?>.png" />
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php
                        foreach (User::$evals as $key => $value) {
                            $this->render('modules/wEval', array(
                                'libel' => $key,
                                'attribute' => $value,
                                'value' => $this->crew['crew_' . $value]
                            ));
                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>
