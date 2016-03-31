<?php

class Plan extends Model
{
    public function getSearch($criterias, $offset = 0)
    {
        $plans = $this->query()->join(array('crew'))->orderBy(array('plan_date_debut DESC'))->select();

        foreach ($plans as $key => $plan) {
            $users = $this->query('user')
                ->join(array('user_crew' => 'user_id', 'user_data' => 'user_id'))
                ->select();

            if (!empty($users)) {
                $plans[$key]['users'] = $users;
            }
        }

        return $plans;
    }
}