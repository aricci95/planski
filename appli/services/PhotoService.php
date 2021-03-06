<?php

class PhotoService extends Service
{

    public function deleteFromUser($userId)
    {
        $photo_ids = $this->query('photo')
                          ->where(array('key_id' => $userId, 'type_id' => PHOTO_TYPE_USER))
                          ->select(array('photo_id', 'photo_url'));

        foreach ($photo_ids as $photo) {
            $this->delete($photo['photo_id'], $photo['photo_url']);
        }

        return $this->model->user->deleteById($userId);
    }

    public function delete($id, $path)
    {
        if (file_exists(ROOT_DIR . '/photos/profile/' . $path)) {
            unlink(ROOT_DIR . '/photos/profile/' . $path);
        }

        return $this->model->photo->deleteById($id);
    }

    private function _getExtension($str)
    {
        $str = stripslashes($str);
        $i   = strrpos($str, ".");

        if (! $i) {
            return "";
        }

        $l   = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);

        return strtolower($ext);
    }

    public function uploadImage($name, $tmp_name, $type_id, $key_id)
    {
        if (empty($name) || empty($tmp_name)) {
            throw new Exception("Une erreur est survenue, merci de réessayer l'upload.");
        }

        $extension = $this->_getExtension($name);

        if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif') {
            throw new Exception('Type d\'image  inconnu');
        } else {
            $size = filesize($tmp_name);

            if ($size > MAX_SIZE * 1024) {
                throw new Exception('Votre image est trop lourde');
            }

            list($width, $height) = getimagesize($tmp_name);

            if ($width > MAX_DIMENSION || $height > MAX_DIMENSION) {
                throw new Exception('Votre image est trop grande <br/> (dimensions max : ' . MAX_DIMENSION . ' x ' . MAX_DIMENSION . ')');
            }

            if ($extension == 'jpg' || $extension == 'jpeg') {
                $src = imagecreatefromjpeg($tmp_name);
            } else if ($extension == 'png') {
                $src = imagecreatefrompng($tmp_name);
            } else if ($extension == 'gif') {
                $src = imagecreatefromgif($tmp_name);
            } else {
                throw new Exception('Extension de fichier non supporté.');
            }

            // PROFILE (qualibrage de la largeur)
            $profileTmp = null;
            $profilewidth = $width;
            $profileheight = $height;
            $profileTmp = imagecreatetruecolor($profilewidth, $profileheight);
            imagecopyresampled($profileTmp, $src, 0, 0, 0, 0, $profilewidth, $profileheight, $width, $height);

            $photo_data['photo_url'] = uniqid().'.'. $extension;
            $photo_data['type_id']   = (int) $type_id;
            $photo_data['key_id']    = (int) $key_id;

            if ($type_id == PHOTO_TYPE_USER) {
                if($this->query('user')->updateById($this->context->get('user_id'), array('user_photo_url' => $photo_data['photo_url']))) {
                    $this->context->set('user_photo_url', $photo_data['photo_url']);
                } else {
                    throw new Exception('Impossible d\'enregistrer la photo, merci de réessayer.');
                }
            } else {
                if (!$this->model->photo->insert($photo_data)) {
                    throw new Exception('Impossible d\'enregistrer la photo, merci de réessayer.');
                }
            }

            $filename  = ROOT_DIR . '/photos/profile/' . $photo_data['photo_url'];

            // Creation
            imagejpeg($profileTmp, $filename, 100);

            // DESTRUCTION
            imagedestroy($src);
            imagedestroy($profileTmp);

            return $photo_data['photo_url'];

        }
    }
}
