<script type="text/javascript" src="planski/libraries/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="planski/libraries/chat/js/chat.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="planski/libraries/growler/js/gritter.js"></script>
<script>
    $.extend($.gritter.options, {
        position: 'bottom-right'
    });
</script>
<?php if(count($this->_growlerMessages) > 0) :
    foreach($this->_growlerMessages as $message) :
        echo $message;
    endforeach;
endif;

if($this->isJSActivated(JS_DATEPICKER)) : ?>
    <link rel="stylesheet" type="text/css" href="planski/libraries/datepicker/jquery.datetimepicker.css"/ >
    <script type="text/javascript" src="planski/libraries/datepicker/jquery.datetimepicker.js"></script>
    <script type="text/javascript" src="planski/libraries/datepicker/datepicker.js"></script>
<?php endif;
if($this->isJSActivated(JS_AUTOCOMPLETE)) : ?>
    <link rel="stylesheet" href="planski/libraries/jquery-ui/jquery-ui.css">
    <script src="planski/libraries/jquery-ui/jquery-ui.js"></script>
    <script src="planski/appli/js/autocomplete.js"></script>
<?php endif;
if($this->isJSActivated(JS_SCROLL_REFRESH)) : ?>
    <script type="text/javascript" src="planski/appli/js/scrollRefresh.js"></script>
<?php endif;
if($this->isJSActivated(JS_PHOTO)) : ?>
    <script type="text/javascript" src="planski/appli/js/photo.js"></script>
<?php endif;
if($this->isJSActivated(JS_SEARCH)) : ?>
    <script type="text/javascript" src="planski/appli/js/search.js"></script>
<?php endif;
if($this->isJSActivated(JS_MODAL)) : ?>
    <link rel="stylesheet" type="text/css" href="planski/libraries/modal/css/magnific-popup.css" />
    <script type="text/javascript" src="planski/libraries/modal/js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="planski/appli/js/modal.js"></script>
<?php endif; ?>