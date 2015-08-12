<?php
namespace App\Collection;

/**
 * Класс описания коллекции девушки.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionGirl implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Девушки';
    }

    /**
     * {@inheritdoc}
     */
    public function getMainImage() {
        return 30;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages() {
        return [
            30,31,32,33,35,36,38,39
        ];
    }
}
