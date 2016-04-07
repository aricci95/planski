<?php

class Comment extends Model
{
    public function getFeed($planId)
    {
        $comments = $this->query('comment')
                         ->join(array('user' => 'user_id'))
                         ->where(array('plan_id' => $planId))
                         ->select(array(
                            'id',
                            'LEFT(created, 10) as created',
                            'LEFT(modified, 10) as modified',
                            'content',
                            'CONCAT(user_prenom, " ", user_nom) as fullname',
                            'CONCAT("planski/photos/profile/", user_photo_url) as profile_picture_url',
                            '(comment.user_id = ' . $this->context->get('user_id') .') as created_by_current_user',
                            'upvote_count',
                            'user_has_upvoted',
                            'parent',
                            'file_url',
                            'file_mime_type',
                         ));

        foreach ($comments as $key => $comment) {
            $comments[$key]['created_by_current_user'] = (int) $comments[$key]['created_by_current_user'];
            $comments[$key]['upvote_count'] = (int) $comments[$key]['upvote_count'];
            $comments[$key]['user_has_upvoted'] = (int) $comments[$key]['user_has_upvoted'];
        }

        return $comments;
    }
}
