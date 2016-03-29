<?php

class Appart extends AppModel
{

    public function getSearch($criterias, $offset = 0)
    {
        $sql = 'SELECT
                    user.user_id as user_id,
                    user_login,
                    UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion,
                    user_photo_url,
                    ville_nom_reel,
                    LEFT(ville_code_postal, 2) as ville_code_postal,
                    appart_libel,
                    appart_size,
                    appart_room,
                    appart_bath,
                    appart_users,
                    appart_type,
                    appart_description,
                    appart_zone_info,
                    appart_equipment_info
                FROM
                    appart
                LEFT JOIN user ON (appart.user_id = user.user_id)
                LEFT JOIN city ON (user.ville_id = city.ville_id)
                WHERE TRUE
            ';

        if (!empty($criterias['search_distance'])) {
            $longitude = $this->context->get('ville_longitude_deg');
            $latitude = $this->context->get('ville_latitude_deg');

            $sql .= ' AND ville_longitude_deg BETWEEN :longitude_begin AND :longitude_end
                      AND ville_latitude_deg BETWEEN :latitude_begin AND :latitude_end ';
        }

        $sql .= ' ORDER BY user_last_connexion DESC
                  LIMIT :limit_begin, :limit_end;';

        $sql = str_replace(',)', ')', $sql);
        $sql = str_replace(', )', ')', $sql);

        $stmt = $this->db->prepare($sql);

        if (!empty($criterias['search_distance'])) {
            $ratio = COEF_DISTANCE * $criterias['search_distance'];

            $stmt->bindValue('longitude_begin', ($longitude - $ratio), PDO::PARAM_INT);
            $stmt->bindValue('longitude_end', ($longitude + $ratio), PDO::PARAM_INT);

            $stmt->bindValue('latitude_begin', ($latitude - $ratio), PDO::PARAM_INT);
            $stmt->bindValue('latitude_end', ($latitude + $ratio), PDO::PARAM_INT);
        }

        $stmt->bindValue('limit_begin', $offset * NB_SEARCH_RESULTS, PDO::PARAM_INT);
        $stmt->bindValue('limit_end', NB_SEARCH_RESULTS, PDO::PARAM_INT);

        $users = $this->db->executeStmt($stmt)->fetchAll();

        foreach ($users as $key => $user) {
            $photos = Model_Manager::getInstance()->Photo->getPhotosByKey($user['user_id'], PHOTO_TYPE_USER);

            if (!empty($photos)) {
                $users[$key]['photos'] = $photos;
            }
        }

        return $users;
    }
}