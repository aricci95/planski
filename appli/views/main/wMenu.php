<div class="snow" style="z-index: 500;">
    <div class="i-large"></div>
    <div class="i-medium"></div>
    <div class="i-small"></div>
</div>
<div class="menu">
    <?php if($this->context->get('user_id')) : ?>
        <?php if($this->context->get('role_id') == Auth::ROLE_OWNER) : ?>
            <a class="menuLien" href="location">Locations</a>
            <a class="menuLien" href="virement">Virements</a>
            <a class="menuLien" href="agenda">Agenda</a>
        <?php else : ?>
            <a class="menuLien" href="user">Membres</a>
            <a class="menuLien" href="crew">Crews</a>
            <a class="menuLien" href="plan/feed/1">Plans</a>
            <a class="menuLien" href="appart">Apparts</a>
        <?php endif; ?>

        <?php if($this->context->get('role_id') == Auth::ROLE_SUPER_ADMIN) : ?>
            <a class="menuLien" <?php echo ($this->page == 'admin') ? 'style="color:white;"' : ''; ?> href="admin">Admin</a></td>
        <?php endif; ?>
    <?php endif; ?>
</div>