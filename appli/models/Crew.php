<?php

class Crew extends AppModel
{
    public function getSearch($criterias, $offset = 0)
    {
        $sql = 'SELECT
                    crew.crew_id,
                    user.user_id as user_id,
                    user_login,
                    FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) AS age,
                    UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion,
                    user_photo_url,
                    ville_nom_reel,
                    LEFT(ville_code_postal, 2) as ville_code_postal,
                    crew_name
                FROM
                    crew
                JOIN user_crew ON (crew.crew_id = user_crew.crew_id)
                JOIN user ON (user_crew.user_id = user.user_id)
                JOIN city ON (user.ville_id = city.ville_id)
                WHERE TRUE
            ';

        if (!empty($criterias['search_gender'])) {
            $sql .= " AND user_gender = :user_gender ";
        }

        if (!empty($criterias['search_age'])) {
            $sql .= " AND FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) <= :search_age ";
        }

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

        if (!empty($criterias['search_gender'])) {
            $stmt->bindValue('user_gender', $criterias['search_gender'], PDO::PARAM_INT);
        }

        if (!empty($criterias['search_age'])) {
            $stmt->bindValue('search_age', $criterias['search_age'], PDO::PARAM_INT);
        }

        if (!empty($criterias['search_distance'])) {
            $ratio = COEF_DISTANCE * $criterias['search_distance'];

            $stmt->bindValue('longitude_begin', ($longitude - $ratio), PDO::PARAM_INT);
            $stmt->bindValue('longitude_end', ($longitude + $ratio), PDO::PARAM_INT);

            $stmt->bindValue('latitude_begin', ($latitude - $ratio), PDO::PARAM_INT);
            $stmt->bindValue('latitude_end', ($latitude + $ratio), PDO::PARAM_INT);
        }

        $stmt->bindValue('limit_begin', $offset * NB_SEARCH_RESULTS, PDO::PARAM_INT);
        $stmt->bindValue('limit_end', NB_SEARCH_RESULTS, PDO::PARAM_INT);

        $crews = $this->db->executeStmt($stmt)->fetchAll();

        foreach ($crews as $key => $crew) {
            $users = $this->getUsers($crew['crew_id']);

            if (!empty($users)) {
                $crews[$key]['users'] = $users;
            }
        }

        return $crews;
    }

    public function getUsers($crewId)
    {
        $sql = 'SELECT
                    user.user_id as user_id,
                    user_login,
                    FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) AS age,
                    UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion,
                    user_photo_url,
                    user_description,
                    ville_nom_reel,
                    user_ride,
                    user_level,
                    user_profession,
                    user_cuisine,
                    user_vehicule,
                    user_hygiene,
                    user_fun,
                    LEFT(ville_code_postal, 2) as ville_code_postal,
                    (SELECT LEFT(SUM(rate) / count(*), 1) FROM vote WHERE vote.key_id = user.user_id AND type_id = ' . Vote::TYPE_USER . ') AS rate
                FROM user_crew
                JOIN user ON (user_crew.user_id = user.user_id)
                LEFT JOIN user_data ON (user.user_id = user_data.user_id)
                LEFT JOIN city ON (user.ville_id = city.ville_id)
                WHERE user_crew.crew_id = :crew_id
        ;';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('crew_id', $crewId, PDO::PARAM_INT);

        return $this->db->executeStmt($stmt)->fetchAll();
    }
}