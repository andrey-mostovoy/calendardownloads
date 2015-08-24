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
            20,21,22,23,26,27,28,29,
            803,804,805,806,807,808,809,810,811,812,813,814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,
            829,830,831,832,

        ];
    }
}
