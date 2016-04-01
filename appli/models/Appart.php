<?php

class Appart extends Model
{

    public function getSearch($criterias, $offset = 0)
    {
        $queryBuilder = $this->query()
                             ->leftJoin(array('city' => 'ville_id'));

        return $queryBuilder->select(array('appart_id',
            'ville_nom_reel',
            'LEFT(ville_code_postal, 2) as ville_code_postal',
            'appart_libel',
            'appart_size',
            'appart_room',
            'appart_bath',
            'appart_users',
            'appart_type',
            'appart_description',
            'appart_zone_info',
            'appart_equipment_info',
            '(SELECT LEFT(SUM(rate) / count(*), 1) FROM vote WHERE vote.key_id = appart.appart_id AND type_id = ' . Vote::TYPE_APPART . ') AS rate'
        ));
    }
}