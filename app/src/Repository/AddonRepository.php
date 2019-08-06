<?php

class AddonRepository extends AppRepository
{
    public function __construct()
    {
        $class = 'AttributeRead';
        parent::__construct('addons', $class);
    }

    public function findAttributes($userId, $type = MYSQLI_ASSOC)
    {
        $sql = Db::query('Select  ua.id, ua.value, ua.addon_id,  ua.user_id, addo.name, addo.type from addons as addo
        LEFT OUTER JOIN attributes as ua ON ua.addon_id = addo.id
        WHERE ua.user_id = ' . $userId
        );

        $result = [];
        if ($sql != null) {
            while (($row = $sql->fetch_array($type)) != null) {
                //  var_dump($row);
                $result[$row['addon_id']] = new Attribute($row);
            }
        }

        return $result;
    }
}