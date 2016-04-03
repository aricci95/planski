<?php

class Crew extends Model
{
    public function getSearch($criterias, $offset = 0)
    {
        $crews = $this->query()
                      ->orderBy(array('crew_creation DESC'))
                      ->limit($offset * NB_SEARCH_RESULTS, NB_SEARCH_RESULTS)
                      ->select(array('crew.crew_id', 'crew_name'));

        foreach ($crews as $key => $crew) {
            $totals = array(
                'rate' => 0,
                // 'level' => 0,
                'fun' => 0,
                'cuisine' => 0,
                'hygiene' => 0,
                'cash' => 0,
            );

            $users = $this->getMembers($crew['crew_id'], $criterias);

            if (!empty($users)) {
                $crews[$key]['users'] = $users;
            }

            foreach($users as $user) {
                foreach (User::$evals as $value) {
                    $totals[$value] += $user['user_' . $value];
                }
            }

            foreach ($totals as $index => $value) {
                $crews[$key]['crew_' . $index] = round($value / count($users), 1);
            }

            $apparts = $this->query('plan')
                        ->join(array('plan_appart' => 'plan_id', 'appart' => 'appart_id'))
                        ->where(array('crew_id' => $crew['crew_id']))
                        ->select();

            if (!empty($apparts)) {
                $crews[$key]['apparts'] = $apparts;
            }
        }

        return $crews;
    }

    public function getMembers($crewId, $criterias = array())
    {
        $queryBuilder = $this->query('crew')
                             ->join(array(
                                'user_crew' => 'crew_id',
                                'user_data' => 'user_id',
                                'user' => 'user_id'))
                             ->leftJoin(array('city' => 'ville_id'))
                             ->where(array('crew.crew_id' => $crewId));

        if (!empty($criterias['search_gender'])) {
            $queryBuilder->where(array('user_gender' => $criterias['search_gender']));
        }

        if (!empty($criterias['search_age'])) {
            $queryBuilder->lowerThan(array('search_age' => 'FLOOR((DATEDIFF( CURDATE(), (user_birth))/365))'));
        }

        if (!empty($criterias['search_distance'])) {
            $longitude = $this->context->get('ville_longitude_deg');
            $latitude = $this->context->get('ville_latitude_deg');

            $ratio = COEF_DISTANCE * $criterias['search_distance'];

            $queryBuilder->between(array(
                'ville_longitude_deg' => array(
                    'begin' => ($longitude - $ratio),
                    'end' => ($longitude + $ratio)
                ),
                'ville_latitude_deg' => array(
                    'begin' => ($latitude - $ratio),
                    'end' => ($latitude + $ratio)
                ),
            ));
        }

        return $queryBuilder->select(array('user.user_id',
            'user_prenom',
            'FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) AS age',
            'UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion',
            'user_photo_url',
            'user_description',
            'ville_nom_reel',
            'user_ride',
            'user_level',
            'user_profession',
            'user_cuisine',
            'user_vehicule',
            'user_hygiene',
            'user_fun',
            'user_cash',
            'LEFT(ville_code_postal, 2) as ville_code_postal',
            '(SELECT LEFT(SUM(rate) / count(*), 1) FROM vote WHERE vote.key_id = user.user_id AND type_id = ' . Vote::TYPE_USER . ') AS user_rate'
        ));
    }
}