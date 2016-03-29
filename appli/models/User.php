<?php

class User extends AppModel
{
    const RIDE_SKI       = 1;
    const RIDE_SNOWBOARD = 2;

    const MEDAL_BRONZE = 1;
    const MEDAL_SILVER = 2;
    const MEDAL_GOLD   = 3;
    const MEDAL_EXPERT = 4;

    public static $rides = array(
        self::RIDE_SKI       => 'ski',
        self::RIDE_SNOWBOARD => 'snowboard',
    );

    public static $medals = array(
        self::MEDAL_BRONZE => 'bronze',
        self::MEDAL_SILVER => 'silver',
        self::MEDAL_GOLD   => 'gold',
        self::MEDAL_EXPERT => 'expert',
    );

    public function updateLastConnexion($userId = null)
    {
        if (empty($userId)) {
            $userId = $this->context->get('user_id');
        }

        $sql = 'UPDATE user SET user_last_connexion = NOW() WHERE user_id = :user_id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('user_id', $userId, PDO::PARAM_INT);

        $this->db->executeStmt($stmt);

        return true;
    }

    public function getSearch($criterias, $offset = 0)
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
                FROM
                    user
                LEFT JOIN user_data ON (user.user_id = user_data.user_id)
                LEFT JOIN city ON (user.ville_id = city.ville_id)
                WHERE TRUE
            ';

        if (!empty($criterias['search_login'])) {
            $sql .= " AND user_login LIKE :search_login ";
        }

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

        if (!empty($criterias['search_login'])) {
            $stmt->bindValue('search_login', '%'. $criterias['search_login'] .'%', PDO::PARAM_STR);
        }

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

        $users = $this->db->executeStmt($stmt)->fetchAll();

        foreach ($users as $key => $user) {
            $photos = Model_Manager::getInstance()->Photo->getPhotosByKey($user['user_id'], PHOTO_TYPE_USER);

            if (!empty($photos)) {
                $users[$key]['photos'] = $photos;
            }
        }

        return $users;
    }

    public function getUserByIdDetails($userId)
    {
        $sql = "SELECT
                    user.user_id as user_id,
                    user_login,
                    user_pwd,
                    user_mail,
                    FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) AS age,
                    UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion,
                    user_birth,
                    user_photo_url,
                    user_gender,
                    user_description,
                    ville_nom_reel,
                    user_ride,
                    user_profession,
                    user.ville_id as ville_id,
                    LEFT(ville_code_postal, 2) as ville_code_postal
                FROM
                    user
                LEFT JOIN user_data ON (user.user_id = user_data.user_id)
                LEFT JOIN city ON (user.ville_id = city.ville_id)
                WHERE user.user_id = :user_id
            ;";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('user_id', (int) $userId);

        return $this->db->executeStmt($stmt)->fetch();
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM user WHERE user_id = :id;
                DELETE FROM user_views WHERE viewer_id = :id OR viewed_id = :id;
                DELETE FROM message WHERE destinataire_id = :id OR expediteur_id = :id;
                DELETE FROM chat WHERE `from` = :user_login OR `to` = :user_login;
            ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->bindValue('user_login', $id, PDO::PARAM_STR);

        return $this->db->executeStmt($stmt);
    }

    public function setValid($code)
    {
        $sql = 'UPDATE
                    user
                SET
                    user_valid = 1
                WHERE
                    user_valid = :code';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':code', $code, PDO::PARAM_STR);

        return $this->db->executeStmt($stmt);
    }

    public function isUsedLogin($login)
    {
        $sql = 'SELECT user_id
                FROM   user
                WHERE  user_login = :login';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('login', $login, PDO::PARAM_STR);

        return $this->db->executeStmt($stmt)->fetch();
    }

    public function isUsedEmail($email)
    {
        $sql = 'SELECT user_id
                FROM   user
                WHERE  user_mail = :email';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('email', $email, PDO::PARAM_STR);

        return $this->db->executeStmt($stmt)->fetch();
    }

    public function createUser($items)
    {
        $userValidationId = uniqid();

        $sql = '
            INSERT INTO user (
                user_login,
                user_pwd,
                user_mail,
                user_gender,
                user_subscribe_date,
                role_id,
                user_valid
              ) VALUES (
                :user_login,
                :user_pwd,
                :user_mail,
                :user_gender,
                NOW(),
                :role_id,
                :user_valid
            );
        ';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('user_login', $items['user_login']);
        $stmt->bindValue('user_pwd', $items['user_pwd']);
        $stmt->bindValue('user_mail', $items['user_mail']);
        $stmt->bindValue('user_gender', $items['user_gender']);
        $stmt->bindValue('role_id', AUTH_LEVEL_USER);
        $stmt->bindValue('user_valid', $userValidationId);

        $this->db->executeStmt($stmt);

        return $userValidationId;
    }

    public function findByLoginPwd($login, $pwd)
    {
        $sql = '
                SELECT
                    user_id,
                    user_pwd,
                    user_login,
                    role_id,
                    user_photo_url,
                    FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) AS age,
                    user_gender,
                    user_valid,
                    ville_nom_reel,
                    ville_code_postal,
                    user_mail,
                    user.ville_id as ville_id
                FROM user
                LEFT JOIN city ON user.ville_id = city.ville_id
                WHERE LOWER(user_login) = LOWER(:user_login)
                AND user_pwd = :pwd
            ;';

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('user_login', $login);
            $stmt->bindValue('pwd', $pwd);

            return $this->db->executeStmt($stmt)->fetch();
    }

    public function findByEmail($email)
    {
        $sql = '
                SELECT
                    user_id,
                    user_pwd,
                    user_login,
                    role_id,
                    user_photo_url,
                    FLOOR((DATEDIFF( CURDATE(), (user_birth))/365)) AS age,
                    user_gender,
                    user_valid,
                    ville_nom_reel,
                    user_mail,
                    ville_longitude_deg,
                    ville_latitude_deg,
                    user.ville_id as ville_id
                FROM user
                LEFT JOIN city ON (user.ville_id = city.ville_id)
                WHERE LOWER(user_mail) = LOWER(:email)
            ;';

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('email', $email);

            return $this->db->executeStmt($stmt)->fetch();
    }

}
