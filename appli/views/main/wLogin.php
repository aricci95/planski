<div style="float:right;margin-top:8px;">
    <form action="auth/login" method="post" style="margin: 0;padding: 0;">
        <table cellspacing="0" class="auth">
            <tbody>
                <tr style="color:white;">
                    <td>
                        <label for="user_email">Email ou Login</label>
                    </td>
                    <td>
                        <label for="user_pwd">Mot de passe</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="user_email" name="user_email" tabindex="1" style="width:150px;height:23px;">
                    </td>
                    <td>
                        <input type="user_pwd" name="user_pwd" tabindex="2" style="width:150px;height:23px;">
                    </td>
                    <td>
                        <input value="Go !" tabindex="4" type="submit">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <div style="color:#808080;">
                                <input id="savepwd" type="checkbox" name="savepwd" value="1" checked="1">
                                <label for="savepwd">Se souvenir de moi</label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="lostpwd">Mot de passe oublié?</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
<!--
<span class="greyLink" style="text-align:center; color: white;">
    <form action="auth/login" method="post">
        Login : <input style="margin-top: 11px;margin-left:5px;margin-right:5px;" name="user_login" size="8" />
        Password : <input style="margin-left:5px;" name="user_pwd" type="password" size="8" />
        <input type="submit" value="Connexion" />
        <input type="button" onclick="window.location.href = 'planski/libraries/socialauth/station.php';" class="facebookButton" value="Via Facebook" />
        <label style="margin-left:5px;" for="savepwd">Enregistrer</label><input id="savepwd" name="savepwd" type="checkbox" />
    </form>
</span>
<!--
<span style="position:absolute;right:20;top:25;">
    <a class="menuLien" style="margin-left:5px;" href="lostpwd">Mot de passe oublie</a>
    <a class="menuLien" style="margin:0;" href="subscribe">S'inscrire !</a>
</span>
-->
</div>