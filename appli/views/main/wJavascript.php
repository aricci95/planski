<script type="text/javascript" src="planski/libraries/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="planski/libraries/chat/js/chat.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="planski/libraries/growler/js/gritter.js"></script>
<script type="text/javascript" src="planski/appli/js/dropdown.js"></script>
<script type="text/javascript" src="planski/libraries/modal/js/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="planski/appli/js/modal.js"></script>
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
    <script type="text/javascript" src="planski/libraries/datepicker/jquery.datetimepicker.js"></script>
    <script type="text/javascript" src="planski/libraries/datepicker/datepicker.js"></script>
<?php endif;
if($this->isJSActivated(JS_AUTOCOMPLETE)) : ?>
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
if($this->isJSActivated(JS_CREW)) : ?>
    <script type="text/javascript" src="planski/appli/js/crew.js"></script>
<?php endif;
if($this->isJSActivated(JS_FEED)) : ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="planski/libraries/jquery-comments/js/jquery-comments.js"></script>
    <script>
        $(document).ready(function() {
            $('#comments-container').comments({
                profilePictureURL: 'planski/photos/profile/<?php echo $this->context->get('user_photo_url'); ?>',
                postCommentOnEnter: true,
                enableAttachments: true,
                enableNavigation: false,
                getComments: function(success, error) {
                    var commentsArray = [{
                        id: 1,
                        created: '2015-10-01',
                        content: 'Lorem ipsum dolort sit amet',
                        fullname: 'Simon Powell',
                        upvote_count: 2,
                        user_has_upvoted: false
                    }];
                    success(commentsArray);
                }
            });
        });
    </script>
<?php endif;
if($this->isJSActivated(JS_EDIT)) : ?>
    <script type="text/javascript" src="planski/appli/js/edit.js"></script>
<?php endif; ?>