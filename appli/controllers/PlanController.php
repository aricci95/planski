<?php

require_once ROOT_DIR . '/appli/controllers/SearchController.php';

class PlanController extends SearchController
{

    protected $_type = SEARCH_TYPE_PLAN;

    protected $_searchParams = array(
        'search_libel',
    );

    public function render()
    {
        $this->view->addJS(JS_CREW);

        parent::render();
    }

    public function renderFeed()
    {
        $this->view->addJS(JS_FEED);

        $this->view->plan = $this->model->plan->getById($this->context->getParam('value'));

        $this->view->current_step = 3;

        $this->view->steps = $this->model->query('step')->select();

        $this->view->setTitle($this->view->plan['crew_name']);
        $this->view->setViewName('plan/wMain');
        $this->view->render();
    }

    public function renderGetComments()
    {
        $planId = $this->context->getParam('value');

        echo json_encode($this->model->comment->getFeed($planId));
    }

    public function renderPostComment()
    {
        $comment = $this->context->params;

        $date = date('Y-m-d H:i:s');

        if (!empty($comment['modified'])) {
            $comment['modified'] = $date;

            $id = $comment['id'];

            unset($comment['id']);

            if ($this->model->query('comment')->where(array('id' => $id))->update($comment)) {
                echo JSON_OK;
            } else {
                echo JSON_ERR;
            }
        } else {
            $comment['modified'] = null;
            $comment['created'] = $date;

            if ($this->model->query('comment')->insert($comment)) {
                echo JSON_OK;
            } else {
                echo JSON_ERR;
            }
        }
    }

    public function renderLike()
    {
        $comment = $this->context->params;

        $comment['user_has_upvoted'] = ($comment['user_has_upvoted'] == 'true') ? 1 : 0;
        $comment['upvote_count'] = (int) $comment['upvote_count'];

        unset($comment['id']);

        if ($this->model->query('comment')->where(array('id' => $this->context->getParam('id')))->update($comment)) {
            echo JSON_OK;
        } else {
            echo JSON_ERR;
        }
    }

    public function renderDeleteComment()
    {
        $commentId = $this->context->getParam('id');

        if ($this->model->query('comment')->where(array('id' => $commentId))->delete()) {
            echo JSON_OK;
        } else {
            echo JSON_ERR;
        }
    }

}
