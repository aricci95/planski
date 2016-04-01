<div class="title topShadow">ADMINISTRATION</div>
<div class="shadow"></div>
<form action="admin/<?php echo $this->action; ?>" method="post">
    Utilisateur :
    <select name="user_id" align="center" style="margin:40px;">
        <option value="">selectionner</option>
        <?php
            foreach($this->users as $key => $value) echo '<option value="'.$value["user_id"].'">'.$value["user_prenom"].' ('.$value['user_id'].')</option>';
        ?>
    </select>
<?php $this->_helper->formFooter('admin'); ?>
</form>