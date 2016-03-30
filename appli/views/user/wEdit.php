    <div class="title topShadow">INFORMATIONS</div>
    <div class="shadow"></div>
    <div style="display:inline-block;">
        <form action="profile/save" method="post" enctype="multipart/form-data">
            <?php $this->render('user/wThumb', array('user' => $this->user)); ?>
            <table class="editTable">
                <tr>
                    <th>Email :</th>
                    <td><?php echo $this->user['user_mail']; ?></td>
                </tr>
                <tr>
                    <th>Pseudo :</th>
                    <td>
                        <input name="user_login" value="<?php echo $this->user['user_login']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Photo :</th>
                    <td><input type="file" name="photo" /></td>
                </tr>
                <tr>
                    <th>Mot de passe :</th>
                    <td><input name="user_pwd" type="password" value="" /></td>
                </tr>
                <tr>
                    <th>Vérification mot de passe :</th>
                    <td><input name="verif_pwd" type="password" value="" /></td>
                </tr>
                <tr>
                    <th>Adresse :</th>
                    <td><input name="user_adresse" value="<?php echo $this->user['user_adresse']; ?>" /></td>
                </tr>
                <tr>
                    <th>Ville :</th>
                    <td>
                        <input type="text" class="autocomplete" data-type="city" value="<?php if (!empty($this->user['ville_nom_reel'])) : echo $this->user['ville_nom_reel'] . ' ('. $this->user['ville_code_postal'] . ')'; endif; ?>" />
                        <input type="hidden" name="ville_id" class="autocompleteValue" />
                    </td>
                </tr>
                <tr>
                    <th>Sexe :</th>
                    <td>
                        <select name="user_gender">
                            <option value="">selectionnez</option>
                            <option value="1" <?php if($this->user['user_gender'] == 1) echo 'selected="selected" '; ?>>Homme</option>
                            <option value="2" <?php if($this->user['user_gender'] == 2) echo 'selected="selected" '; ?>>Femme</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Date de naissance :</th>
                    <td>
                        <input name="user_birth" class="datetimepicker" id="datetimepicker" type="text" format="d/m/Y" value="<?php if(!empty($this->user['user_birth'])) echo date("d/m/Y", strtotime($this->user['user_birth'])); ?>">
                    </td>
                </tr>
                    <th>Profession :</th>
                    <td><input name="user_profession" size="40" value="<?php echo !empty($this->user['user_profession']) ? $this->user['user_profession'] : ''; ?>" /></td>
                <tr>
                    <th>Description longue :</th>
                    <td><textarea name="user_description" cols="40" rows="7"><?php echo $this->user['user_description']; ?></textarea></td>
                </tr>
                <tr>
                    <th>Poids :</th>
                    <td>
                        <select name="user_poids">
                            <?php if (empty($this->user['user_poids'])) :
                                $this->user['user_poids'] = 0;
                            endif;
                            for($i=8; $i<=20; $i++) : ?>
                                <option <?php if((integer) $this->user['user_poids'] == ($i*5)) : ?>selected="selected"<?php endif; ?> value="<?php echo ($i*5); ?>"><?php echo ($i*5); ?></option>
                            <?php endfor; ?>
                        </select> kg
                    </td>
                </tr>
                <tr>
                    <th>Taille :</th>
                    <td>
                        <select name="user_taille">
                            <?php if (empty($this->user['user_taille'])) :
                                $this->user['user_taille'] = 0;
                            endif;
                            for($i=25; $i<=42; $i++) : ?>
                                <option <?php if((integer) $this->user['user_taille'] == ($i*5)) : ?>selected="selected"<?php endif; ?> value="<?php echo ($i*5); ?>"><?php echo ($i*5); ?></option>
                            <?php endfor; ?>
                        </select> cm
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height:100px;">
                        <input type="submit" value="enregistrer" style="width:200px;height:30px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="title topShadow">GENERAL</div>
    <div class="shadow"></div>
    <div style="display:inline-block;">
        <table class="editTable">
            <tr style="height:70px;">
                <th style="width: 128px;">Ski / Snowboard :</th>
                <td>
                    <a class="radio_img" href="#">
                        <img <?php echo ($this->user['user_ride'] == User::RIDE_SKI) ? 'class="selected"' : ''; ?> data-name="user_ride" data-value="1" src="/planski/images/icones/ski.png" />
                        <input style="display:none" type="radio" name="user_ride" value="1" <?php echo ($this->user['user_ride'] == User::RIDE_SKI) ? 'checked' : '' ; ?>>
                    </a>
                    <a class="radio_img" href="#">
                        <img <?php echo ($this->user['user_ride'] == User::RIDE_SNOWBOARD) ? 'class="selected"' : ''; ?> data-name="user_ride" data-value="2" src="/planski/images/icones/snowboard.png" />
                        <input style="display:none" type="radio" name="user_ride" value="2" <?php echo ($this->user['user_ride'] == User::RIDE_SNOWBOARD) ? 'checked' : '' ; ?>>
                    </a>
                </td>
            </tr>
            <tr style="height:100px;">
                <th style="width: 128px;">Niveau :</th>
                <td>
                    <?php for ($i = 0; $i <= 3; $i++) : ?>
                        <a class="radio_img" href="#">
                            <img <?php echo ($this->user['user_level'] == $i) ? 'class="selected"' : ''; ?> data-name="user_level" data-value="<?php echo $i; ?>" src="/planski/images/medals/<?php echo $i; ?>.png" />
                            <input style="display:none" type="radio" name="user_level" value="<?php echo $i; ?>" <?php echo ($this->user['user_level'] == $i) ? 'checked' : '' ; ?>>
                        </a>
                    <?php endfor; ?>
                    <br/>
                    <?php for ($i = 5; $i <= 7; $i++) : ?>
                        <a class="radio_img" href="#">
                            <img <?php echo ($this->user['user_level'] == $i) ? 'class="selected"' : ''; ?> data-name="user_level" data-value="<?php echo $i; ?>" src="/planski/images/medals/<?php echo $i; ?>.png" />
                            <input style="display:none" type="radio" name="user_level" value="<?php echo $i; ?>" <?php echo ($this->user['user_level'] == $i) ? 'checked' : '' ; ?>>
                        </a>
                    <?php endfor; ?>
                </td>
            </tr>
        </table>
        <table class="editTable">
            <tr style="height:40px;">
                <th style="width:80px;">Cuisine :</th>
                <td style="position: absolute;">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                        <a class="cursor_img" href="#">
                            <img data-name="user_cuisine" data-value="<?php echo $i; ?>" <?php echo ($this->user['user_cuisine'] >= $i) ? '' : 'class="opacity"'; ?> src="/planski/images/icones/food.png" />
                            <input style="display:none" type="radio" name="user_cuisine" value="<?php echo $i; ?>" <?php echo ($this->user['user_cuisine'] == $i) ? 'checked' : '' ; ?>>
                        </a>
                    <?php endfor; ?>
                </td>
            </tr>
            <tr style="height:40px;">
                <th style="width:80px;">Fun :</th>
                <td style="position: absolute;">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                        <a class="cursor_img" href="#">
                            <img data-name="user_fun" data-value="<?php echo $i; ?>" <?php echo ($this->user['user_fun'] >= $i) ? '' : 'class="opacity"'; ?> src="/planski/images/icones/fun.png" style="margin-right:12px;" />
                            <input style="display:none" type="radio" name="user_fun" value="<?php echo $i; ?>" <?php echo ($this->user['user_fun'] == $i) ? 'checked' : '' ; ?>>
                        </a>
                    <?php endfor; ?>
                </td>
            </tr>
            <tr style="height:40px;">
                <th style="width:80px;">Hygiène :</th>
                <td style="position: absolute;">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                        <a class="cursor_img" href="#">
                            <img data-name="user_hygiene" data-value="<?php echo $i; ?>" <?php echo ($this->user['user_hygiene'] >= $i) ? '' : 'class="opacity"'; ?> src="/planski/images/icones/hygiene.png" style="margin-right:12px;" />
                            <input style="display:none" type="radio" name="user_hygiene" value="<?php echo $i; ?>" <?php echo ($this->user['user_hygiene'] == $i) ? 'checked' : '' ; ?>>
                        </a>
                    <?php endfor; ?>
                </td>
            </tr>
            <tr style="height:40px;">
                <th style="width:80px;">Dépenses :</th>
                <td style="position: absolute;">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                        <a class="cursor_img" href="#">
                            <img data-name="user_cash" data-value="<?php echo $i; ?>" <?php echo ($this->user['user_cash'] >= $i) ? '' : 'class="opacity"'; ?> src="/planski/images/icones/cash.png" style="margin-right:10px;" />
                            <input style="display:none" type="radio" name="user_cash" value="<?php echo $i; ?>" <?php echo ($this->user['user_cash'] == $i) ? 'checked' : '' ; ?>>
                        </a>
                    <?php endfor; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="title topShadow">COMPTE</div>
    <div class="shadow"></div>
    <img src="planski/images/icones/delete.png"/>
    <a href="profile/delete">Supprimer mon compte</a>
    <div style="height:50px;"></div>

