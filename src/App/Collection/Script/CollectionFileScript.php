<?php
namespace App\Collection\Script;

use App\Collection\CollectionCategory;
use App\Image\Image;
use Imagine\Exception\InvalidArgumentException;
use Imagine\Image\Box;
use Imagine\Imagick\Imagine;

/**
 * Скрипт берет файлы из дирректории preset/create/ и нарезает нужные размеры.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionFileScript extends CollectionUrlScript {
    /**
     * {@inheritdoc}
     */
    public function run() {
        $Imagine = new Imagine();

        $ids = [];
        $id = $this->getFileCount();

        foreach (CollectionCategory::getAllCategories() as $category) {
            $dirName = IMG_CREATE . $category . '/';
            if (!is_dir($dirName)) {
                continue;
            }

            $DirHandler = opendir($dirName);

            while ($file = readdir($DirHandler)) {
                if ($file == '.' || $file == '..') {
                    continue;
                }

                $imageName = $dirName . $file;

                $id++;

                echo 'Processed category ' . $category . ', file ' . $file . PHP_EOL;

                try {
                    $Image = $Imagine->open($imageName);
                } catch (InvalidArgumentException $Ex) {
                    echo $Ex->getMessage() . ' file: ' . $imageName . PHP_EOL;
                    continue;
                }

                $fileName = Image::getName($category, $id);

                $Image->save(IMG_1920x1080 . $fileName);

                $Image->resize(new Box(500, 281))->save(IMG_500xY . $fileName);
                $Image->resize(new Box(230, 129))->save(IMG_230xY . $fileName);

                unlink($imageName);

                $ids[$category][] = $id;
            }
        }

        $result = [];
        foreach ($ids as $category => $imageIds) {
            $result[$category] = json_encode($imageIds);
        }

        file_put_contents('ids.txt', var_export($result, true));

        var_dump($result);
        echo PHP_EOL . 'See ids.txt' . PHP_EOL . PHP_EOL;
    }
}
