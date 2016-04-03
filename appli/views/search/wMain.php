<form id="search_form" action="#" method="post">
    <div class="form formTopShadow" id="search_form_table" align="center">
        <span id="search_criterias">
            <?php $this->render($this->type . '/wForm'); ?>
        </span>
        <input id="submit_button" type="submit" src="planski/images/boutons/bnt_search.png" ALT="Rechercher" value="Chercher" />
    </div>
</form>
 <?php if (empty($this->elements)) : ?>
        <div align="center" class="noresults">
            Aucun résultat pour les critères choisis.
        </div>
<?php else : ?>
    <div align="center" class="results" style="overflow: hidden;">
        <?php $this->render('search/wItems'); ?>
    </div>
    <img class="loading" src="planski/images/icones/loading.gif" style="display:none;" data-show="false" data-end="false" data-offset="0" data-href="<?php echo $this->type; ?>" />
<?php endif; ?>
