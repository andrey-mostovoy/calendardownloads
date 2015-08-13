<?php
namespace App\Gallery;

use App\Collection\Collection;
use Core\Page\AbstractWebPage;

/**
 * Страница с галлереей.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class GalleryPage extends AbstractWebPage {
    public function run() {
        $category = $this->getArg('category');

        if ($category) {
            $this->bind('category', $category);
            $Collection = Collection::getCollectionByCategory($category);
            $this->bind('availableImages', $this->prepareList($Collection->getImages()));
        } else {
            $this->bind('availableCategories', $this->prepareList(Collection::getAllCollections()));
        }

        return true;
    }

    /**
     * Разбивает линейный массив групками по n элементов.
     * @param array $list
     * @param int $n
     * @return array
     */
    private function prepareList($list, $n = 3) {
        $result = [];
        $key = 0;
        $i = 0;

        foreach ($list as $k => $item) {
            if (!is_numeric($k)) {
                $result[$key][$k] = $item;
            } else {
                $result[$key][] = $item;
            }

            $i++;
            if ($i == $n) {
                $i = 0;
                $key++;
            }
        }

        return $result;
    }
}
