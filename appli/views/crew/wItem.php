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
