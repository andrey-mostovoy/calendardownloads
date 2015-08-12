<?php
namespace App\Image;

/**
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 * @task
 */
class Image {
    const EXTENSION = '.jpg';

    public static function getName($category, $id) {
        return $category . $id . self::EXTENSION;
    }
}
