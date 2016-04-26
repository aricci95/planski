<div class="contentBox">
    <form action="location/save" method="post">
        <table class="subscribeForm">
            <tr>
                <td colspan="2">
                    <h2>Localisation</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedInput" type="text" name="location_adresse" placeholder="Adresse" />
                </td>
            </tr>
            <tr>
                <td>
                    <input class="roundedInput" type="text" name="ville_id" placeholder="Ville" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Type de logement :</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="grid">
                        <input type="hidden" name="location_type" value="" />
                        <button type="button" class="" data-value="1" data-name="location_type">
                            Appartement
                        </button>
                        <button type="button" class="selected" data-value="2" data-name="location_type">
                            Maison
                        </button>
                        <button type="button" class="" data-value="3" data-name="location_type">
                            Studio
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Nombre de chambres :</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="grid">
                        <input type="hidden" name="location_room" value="" />
                        <?php for ($i = 1; $i <= 8; $i++) : ?>
                            <button type="button" class="" style="width:70px;" data-value="<?php echo $i; ?>" data-name="location_room">
                                <?php echo $i; ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Commodités :</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="grid multiple">
                        <input type="hidden" name="location_assets" value="" />
                        <?php foreach (Location::$assets as $id => $libelle) : ?>
                            <button type="button" class="" style="width:130px;height:130px;" data-value="<?php echo $id; ?>" data-name="location_assets">
                                <?php echo $libelle; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:100px;text-align:center;">
                    <input class="submitButton" size="20" type="submit" value="Enregistrer" />
                </td>
            </tr>
        </table>
    </form>
</div>