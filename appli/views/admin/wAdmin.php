<?php if($this->context->get('role_id') == AUTH_LEVEL_SUPERADMIN) : ?>
    <div class="title topShadow">ADMINISTRATION</div>
    <div class="shadow"></div>
    <ul align="center" style="list-style-type: none;margin-left:-44px;">
        <li><a href="admin/switch">Prendre la place d'un utilisateur</a></li>
        <li><a href="admin/deleteUser">Supprimer un utilisateur</a></li>
        <li><a href="admin/message">Message à tous les utilisateurs</a></li>
     </ul>
<?php endif; ?>
