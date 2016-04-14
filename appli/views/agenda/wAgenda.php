<form id="search_form" action="#" method="post">
    <div class="form formTopShadow" id="search_form_table" align="center">
        <span id="search_criterias">
            Date début :
             <input name="search_debut" class="datetimepicker" id="datetimepicker_debut" type="text" format="d/m/Y" value="<?php if(!empty($this->user['search_debut'])) echo date("d/m/Y", strtotime($this->user['search_debut'])); ?>">
            Date fin :
            <input name="search_fin" class="datetimepicker" id="datetimepicker_fin" type="text" format="d/m/Y" value="<?php if(!empty($this->user['search_fin'])) echo date("d/m/Y", strtotime($this->user['search_fin'])); ?>">
        </span>
        <input id="submit_button" type="submit" src="planski/images/boutons/bnt_search.png" ALT="Rechercher" value="Chercher" />
    </div>
</form>
<div align="center" class="results">
    <div class="grey" style="width: 950px;margin:10px;padding:20px;">
        <div id='calendar'></div>
    </div>
</div>