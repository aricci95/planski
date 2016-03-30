<?php

class Plan extends Model
{
    public function getSearch($criterias, $offset = 0)
    {
        $builder = new QueryBuilder('plan');
        $plans = $builder->join(array('crew'))->select();

        foreach ($plans as $key => $plan) {
            $users = $builder->table('user')
                             ->join(array('crew'))
                             ->where(array('crew_id' => $plan['crew_id']))
                             ->select();

            if (!empty($users)) {
                $plans[$key]['users'] = $users;
            }
        }

        return $plans;
    }
}