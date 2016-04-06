<div class="snow" style="z-index: 500;">
    <div class="i-large"></div>
    <div class="i-medium"></div>
    <div class="i-small"></div>
</div>
<div class="menu">
    <?php if($this->context->get('user_id')) : ?>
        <a class="menuLien" <?php echo ($this->page == 'member') ? 'style="color:white;"' : ''; ?> href="user">Membres</a>
        <a class="menuLien" <?php echo ($this->page == 'crew') ? 'style="color:white;"' : ''; ?> href="crew">Crews</a>
        <a class="menuLien" <?php echo ($this->page == 'appart') ? 'style="color:white;"' : ''; ?> href="appart">Apparts</a>
        <a class="menuLien" <?php echo ($this->page == 'plans') ? 'style="color:white;"' : ''; ?> href="plan/feed/1">Plans</a>
        <?php if(false && $this->context->get('role_id') == AUTH_LEVEL_SUPERADMIN) : ?>
            <a class="menuLien" <?php echo ($this->page == 'admin') ? 'style="color:white;"' : ''; ?> href="admin">Admin</a></td>
        <?php endif; ?>
    <?php endif; ?>
</div>