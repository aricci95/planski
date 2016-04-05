<?php

class Plan extends Model
{
    public function getSearch($criterias, $offset = 0)
    {
        $plans = $this->query('crew')
                      ->join('plan')
                      ->select();

        foreach ($plans as $key => $plan) {
            $users = Model_Manager::getInstance()->crew->getMembers($plan['crew_id']);

            if (!empty($users)) {
                $plans[$key]['users'] = $users;
            }

            $apparts = $this->query('plan_appart')
                            ->join(array('appart' => 'appart_id'))
                            ->select();

            if (!empty($apparts)) {
                $plans[$key]['apparts'] = $apparts;
            }
        }

        return $plans;
    }

    public function getById($id)
    {
        $plan = $this->query('crew')
                      ->join('plan')
                      ->where(array('plan_id' => $id))
                      ->single()
                      ->select();

        $users = Model_Manager::getInstance()->crew->getMembers($plan['crew_id']);

        if (!empty($users)) {
            $plan['users'] = $users;
        }

        $apparts = $this->query('plan_appart')
                        ->join(array('appart' => 'appart_id'))
                        ->select();

        if (!empty($apparts)) {
            $plan['apparts'] = $apparts;
        }

        return $plan;
    }
}