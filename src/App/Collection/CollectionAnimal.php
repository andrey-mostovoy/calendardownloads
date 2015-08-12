<?php
namespace App\Collection;

/**
 * Класс описания коллекции животных.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionAnimal implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Животные';
    }

    /**
     * {@inheritdoc}
     */
    public function getMainImage() {
        return 9;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages() {
        return [
            9,11,12,13,14
        ];
    }
}
