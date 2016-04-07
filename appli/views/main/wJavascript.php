<script src="planski/libraries/jquery-2.0.0.min.js"></script>
<script src="planski/libraries/tooltipmenu/js/modernizr.custom.js"></script>
<script type="text/javascript" src="planski/libraries/chat/js/chat.js"></script>
<script type="text/javascript" src="planski/libraries/growler/js/gritter.js"></script>
<script type="text/javascript" src="planski/libraries/modal/js/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="planski/appli/js/modal.js"></script>
<script src="planski/libraries/tooltipmenu/js/cbpTooltipMenu.min.js"></script>

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
    <script src="planski/libraries/timeline/js/jquery.timelinr-0.9.6.js"></script>
    <script type="text/javascript" src="planski/libraries/jquery-comments/js/jquery-comments.js"></script>
    <script>
        $(document).ready(function() {
            $('#comments-container').comments({
                profilePictureURL: 'planski/photos/profile/<?php echo $this->context->get('user_photo_url'); ?>',
                postCommentOnEnter: true,
                enableAttachments: true,
                getComments: function(success, error) {
                    $.ajax({
                        type: 'get',
                        url: '/plan/getComments/<?php echo $this->plan['plan_id']; ?>',
                        success: function(commentsArray) {
                            var arr = $.parseJSON(commentsArray);

                            success(arr)
                        },
                        error: error
                    });
                }
            });

            $('#comments-container').comments({
                postComment: function(commentJSON, success, error) {
                    console.log(commentJSON);
                    $.ajax({
                        type: 'post',
                        url: '/plan/postComment',
                        data: {
                            id : commentJSON.id,
                            content : commentJSON.content,
                            created : commentJSON.created,
                            parent : commentJSON.parent,
                            upvote_count : commentJSON.upvote_count,
                            user_has_upvoted : commentJSON.user_has_upvoted,
                            plan_id : <?php echo $this->plan['plan_id']; ?>,
                            user_id : <?php echo $this->context->get('user_id'); ?>
                        },
                        success: function(comment) {
                            success(commentJSON);
                            $.gritter.add({
                                text:  'Commentaire ajouté.',
                                class_name : 'gritter-ok'
                            });
                        },
                        error: error
                    });
                }
            });

            $('#comments-container').comments({
                deleteComment: function(commentJSON, success, error) {
                    $.ajax({
                        type: 'post',
                        url: '/plan/deleteComment',
                        data : {
                            id : commentJSON.id
                        },
                        success: function() {
                            success();
                            $.gritter.add({
                                text:  'Commentaire supprimé.',
                                class_name : 'gritter-ok'
                            });
                        },
                        error: error
                    });
                }
            });

            $('#comments-container').comments({
                putComment: function(commentJSON, success, error) {
                    $.ajax({
                        type: 'post',
                        url: '/plan/postComment',
                        data: {
                            id : commentJSON.id,
                            content : commentJSON.content,
                            modified : 1
                        },
                        success: function(comment) {
                            success(commentJSON);
                            $.gritter.add({
                                text:  'Commentaire edité.',
                                class_name : 'gritter-ok'
                            });
                        },
                        error: error
                    });
                }
            });

            $('#comments-container').comments({
                upvoteComment: function(commentJSON, success, error) {
                    console.log(commentJSON);
                    $.ajax({
                        type: 'post',
                        url: '/plan/like',
                        data: {
                            id: commentJSON.id,
                            user_has_upvoted : commentJSON.user_has_upvoted,
                            upvote_count : commentJSON.upvote_count
                        },
                        success: function() {
                            success(commentJSON)
                        },
                        error: error
                    });
                }
            });
        });
    </script>
<?php endif;
if($this->isJSActivated(JS_EDIT)) : ?>
    <script type="text/javascript" src="planski/appli/js/edit.js"></script>
<?php endif; ?>

