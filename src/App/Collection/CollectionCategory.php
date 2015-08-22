<?php
namespace App\Collection;

/**
 * Класс описания категорий галлереи.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionCategory {
    const NATURE = 'nature';
    const ANIMAL = 'animal';
    const CAR = 'car';
    const SPACE = 'space';
    const GIRL = 'girl';
    const PLAIN = 'plain';

    /**
     * Возвращает все доступные категории.
     * @return array
     */
    public static function getAllCategories() {
        return [
            self::NATURE,
            self::ANIMAL,
            self::CAR,
            self::SPACE,
            self::GIRL,
            self::PLAIN,
        ];
    }
}
