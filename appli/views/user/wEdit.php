<form action="profile/save" method="post" enctype="multipart/form-data">
    <div class="title topShadow">GENERAL</div>
    <div class="shadow"></div>
    <div style="display:inline-block;">
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
                <td><input type="file" name="photo" />
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
            <tr>
                <th>Ville :</th>
                <td>
                    <input type="text" class="autocomplete" data-type="city" value="<?php if (!empty($this->user['ville_nom_reel'])) : echo $this->user['ville_nom_reel'] . ' ('. $this->user['ville_code_postal'] . ')'; endif; ?>" />
                    <input type="hidden" name="ville_id" class="autocompleteValue" />
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
                <td colspan="2" style="padding-top:20px;padding-left:100px;">
                    <input type="submit" value="enregistrer" style="width:200px;height:30px;" />
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:50px;padding-left:100px;">
                    <img src="planski/images/icones/delete.png"/>
                    <a href="profile/delete">Supprimer mon compte</a>
                </td>
        </table>
    </div>
</form>

