<?php
namespace App\Collection;

/**
 * Интерфейс описания коллекции природы.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
interface CollectionInterface {
    /**
     * Возвращает имя коллекции.
     * @return string
     */
    public function getName();

    /**
     * Возвращает главную картинку.
     * @return string
     */
    public function getMainImage();

    /**
     * Возвращает доступный набор картинок.
     * @return array
     */
    public function getImages();
}
