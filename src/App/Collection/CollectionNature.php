<?php
namespace App\Collection;

/**
 * Класс описания коллекции природы.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionNature implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Природа';
    }

    /**
     * {@inheritdoc}
     */
    public function getMainImage() {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages() {
        return [
            1,2,3,5,6,7,8
        ];
    }
}
