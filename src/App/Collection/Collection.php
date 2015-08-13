<?php
namespace App\Collection;

use RuntimeException;

/**
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class Collection {
    /**
     * Возвращает конкретную коллекцию по категории.
     * @param string $category
     * @return CollectionInterface
     */
    public static function getCollectionByCategory($category) {
        switch ($category) {
            case CollectionCategory::NATURE:
                return new CollectionNature();
                break;
            case CollectionCategory::ANIMAL:
                return new CollectionAnimal();
                break;
            case CollectionCategory::CAR:
                return new CollectionCar();
                break;
            case CollectionCategory::SPACE:
                return new CollectionSpace();
                break;
            case CollectionCategory::GIRL:
                return new CollectionGirl();
                break;
            default:
                throw new RuntimeException('category ' . $category . ' did not recognized');
        }
    }

    /**
     * Возвращает все доступные категории.
     * @return array
     */
    public static function getAllCollections() {
        return [
            CollectionCategory::NATURE => new CollectionNature(),
            CollectionCategory::ANIMAL => new CollectionAnimal(),
            CollectionCategory::CAR    => new CollectionCar(),
            CollectionCategory::SPACE  => new CollectionSpace(),
            CollectionCategory::GIRL   => new CollectionGirl(),
        ];
    }
}
