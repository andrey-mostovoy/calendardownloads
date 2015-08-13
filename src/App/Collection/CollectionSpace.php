<?php
namespace App\Collection;

/**
 * Класс описания коллекции космос.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionSpace implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Космос';
    }

    /**
     * {@inheritdoc}
     */
    public function getMainImage() {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages() {
        return [
            20,21,22,23,26,27,28,29
        ];
    }
}
