<div class="contentBox">
    <form action="location/save" method="post">
        <table>
            <tr>
                <td>Adresse :</td>
                <td><input type="text" name="location_adresse" /></td>
            </tr>
            <tr>
                <td>Ville :</td>
                <td><input type="text" name="ville_id" /></td>
            </tr>
            <tr>
                <td colspan="2">Type de logement :</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="grid">
                        <input type="hidden" name="appart_type" value="" />
                        <button type="button" class="" data-value="1" data-name="appart_type">
                            Appartement
                        </button>
                        <button type="button" class="selected" data-value="2" data-name="appart_type">
                            Maison
                        </button>
                        <button type="button" class="" data-value="3" data-name="appart_type">
                            Studio
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:100px;text-align:center;">
                    <input type="submit" value="enregistrer" style="width:200px;height:30px;" />
                </td>
            </tr>
        </table>
    </form>
</div>