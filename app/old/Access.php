<?php

namespace Web\Model;

use Web\App\Model;
use RedBeanPHP\R;

class Access extends Model
{
    const table = 'user_access';

    public static function get_access($id)
    {
        $access_group = R::load('user_access', $id);
        $access = json_decode($access_group['params']);
        $access_all = R::getAll('SELECT * FROM `users_access_all`');
        $access = !empty($access) ? $access : [];

        foreach ($access_all as $id => $item) {
            if (in_array($item['access'], $access)) {
                $access_all[$id]['checked'] = 1;
            } else {
                $access_all[$id]['checked'] = 0;
            }
        }

        $i = 0;
        foreach ($access_all as $item) {
            $access_new[$item['part']][$i]['access'] = $item['access'];
            $access_new[$item['part']][$i]['name'] = $item['name'];
            $access_new[$item['part']][$i]['checked'] = $item['checked'];
            $access_new[$item['part']][$i]['description'] = $item['description'];
            $access_new[$item['part']][$i]['id'] = $item['id'];
            $i++;
        }


        return $access_new;
    }

    public static function update_group($post)
    {
        $bean = R::load('user_access', $post->id);

        foreach ($post as $k => $v) $bean->$k = $v;

        R::store($bean);
    }

    public static function get_all()
    {
        $items = R::findAll('user_access_all');

        $i = 0;
        $access_new = [];
        foreach ($items as $item) {
            $access_new[$item['part']][$i]['access'] = $item['access'];
            $access_new[$item['part']][$i]['description'] = $item['description'];
            $access_new[$item['part']][$i]['name'] = $item['name'];
            $access_new[$item['part']][$i]['id'] = $item['id'];
            $i++;
        }

        return $access_new;
    }

    public static function access_group_create($post)
    {
        $bean = R::xdispense('user_access');
        $bean->name = $post->name;
        $bean->description = $post->description;
        $bean->params = json_encode(get_array($post->keys));
        R::store($bean);
    }

    public static function get_all_groups()
    {
        return R::getAll('SELECT `id`, `name`, `description` FROM `user_access`');
    }

    public static function group_delete($data)
    {
        try {
            R::exec('
                UPDATE `users` SET user_access_id = 0 WHERE user_access_id = :access; 
                DELETE FROM `user_access` WHERE `id` = :access',
                [':access' => $data->id]);
            response(200, 'Дані успішно видалено!');
        } catch (Exception $err) {
            \Web\App\Log::error($err, 'error_delete_access_group');
            response(500, 'Помилка!');
        }
    }
}