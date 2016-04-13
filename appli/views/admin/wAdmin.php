<?php if($this->context->get('role_id') >= Auth::ROLE_ADMIN) : ?>
    <ul align="center" style="list-style-type: none;margin-left:-44px;">
        <li><a href="admin/switch">Prendre la place d'un utilisateur</a></li>
        <li><a href="admin/deleteUser">Supprimer un utilisateur</a></li>
        <li><a href="admin/message">Message à tous les utilisateurs</a></li>
     </ul>
<?php endif; ?>
