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
                    <button type="button" class="">
                        Appartement
                    </button>
                    <button type="button" class="selected">
                        Maison
                    </button>
                    <button type="button" class="">
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