<?php
namespace App\Collection;

/**
 * Класс описания коллекции машин.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionCar implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Машины';
    }

    /**
     * {@inheritdoc}
     */
    public function getMainImage() {
        return 15;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages() {
        return [
            15,16,17,18
        ];
    }
}
