<?php

class Location extends Model
{
    const TYPE_APPART = 1;
    const TYPE_MAISON = 2;
    const TYPE_STUDIO = 3;

    const ASSET_WIFI  = 1;
    const ASSET_TV    = 2;
    const ASSET_LOCAL = 3;
    const ASSET_ASCENCEUR = 4;
    const ASSET_OUTSIDE_PARKING = 5;
    const ASSET_INSIDE_PARKING  = 6;
    const ASSET_RACLETTE = 7;
    const ASSET_FONDUE   = 8;

    public static $assets = array(
        self::ASSET_WIFI => 'Wifi',
        self::ASSET_TV => 'Télévision',
        self::ASSET_LOCAL => 'Local à ski',
        self::ASSET_ASCENCEUR => 'Ascenceur',
        self::ASSET_OUTSIDE_PARKING => 'Parking extérieur',
        self::ASSET_INSIDE_PARKING => 'Parking intérieur',
        self::ASSET_RACLETTE => 'Appareil à raclette',
        self::ASSET_FONDUE => 'Appareil à fondue',
    );

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