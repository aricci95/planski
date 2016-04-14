<?php

class AgendaController extends AppController
{
    protected $_authLevel = array(
        Auth::ROLE_OWNER,
        Auth::ROLE_ADMIN,
    );

    public function render()
    {
        $this->view->addJS(JS_AGENDA);
        $this->view->addJS(JS_DATEPICKER);

        $firstPlan = $this->model
                      ->query('plan')
                      ->single()
                      ->orderBy('plan_date_debut ASC')
                      ->select(array('plan_date_debut as default_date'));

        $this->view->default_date = ($firstPlan) ? $firstPlan['default_date'] : date('Y-m-d');

        $this->view->setTitle('Agenda');
        $this->view->setViewName('agenda/wAgenda');
        $this->view->render();
    }

    public function renderGetEvents()
    {
        $plans = $this->model
                      ->query('crew')
                      ->join(array('plan' => 'crew_id'))
                      ->join(array('plan_appart' => 'plan_id'))
                      ->join(array('appart' => 'appart_id'))
                      ->select(array(
                        'plan.plan_id as plan_id',
                        'appart_libel',
                        'crew_name as title',
                        'plan_date_debut as start',
                        'plan_date_fin as end',
                       ));

        echo json_encode($plans);
    }
}