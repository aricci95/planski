<div class="menu">
    <a class="menuLien" <?php echo ($this->page == 'plan') ? 'style="color:white;"' : ''; ?> href="plan">Plans</a>
    <a class="menuLien" <?php echo ($this->page == 'member') ? 'style="color:white;"' : ''; ?> href="user">Membres</a>
    <a class="menuLien" <?php echo ($this->page == 'crew') ? 'style="color:white;"' : ''; ?> href="crew">Crews</a>
    <a class="menuLien" <?php echo ($this->page == 'appart') ? 'style="color:white;"' : ''; ?> href="appart">Apparts</a>
    <?php if($this->context->get('role_id') == AUTH_LEVEL_SUPERADMIN) : ?>
        <a class="menuLien" <?php echo ($this->page == 'admin') ? 'style="color:white;"' : ''; ?> href="admin">Admin</a></td>
    <?php endif; ?>
</div>