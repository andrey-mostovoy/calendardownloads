<?php
namespace App\Collection;

/**
 * Класс описания коллекции авиамашин.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionPlain implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Авиамашины';
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
