<?php
namespace App\Collection\Script;

use App\Collection\CollectionCategory;
use App\Image\Image;
use Core\Script\AbstractScript;
use Imagine\Exception\InvalidArgumentException;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;

/**
 * Скрипт выкачивает изображения по урл и нарезает нужные размеры
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionUrlScript extends AbstractScript {
    /**
     * {@inheritdoc}
     */
    public function run() {
        $Imagine = new Imagine();

        $ids = [];
        $id = $this->getFileCount();

        foreach ($this->getUrlMap() as $category => $images) {
            foreach ($images as $url) {
                $id++;

                echo 'Processed ' . $url . PHP_EOL;

                $resource = fopen($url, 'r');
                try {
                    $Image = $Imagine->read($resource);
                } catch (InvalidArgumentException $Ex) {
                    echo $Ex->getMessage() . ' Url: ' . $url . PHP_EOL;
                    continue;
                }

                $fileName = Image::getName($category, $id);

                $Image->save(IMG_1920x1080 . $fileName);

                $Image->resize(new Box(500, 281))->save(IMG_500xY . $fileName);
                $Image->resize(new Box(230, 129))->save(IMG_230xY . $fileName);

                $ids[$category][] = $id;
                echo '.... done ' . PHP_EOL;
            }
        }

        $result = [];
        foreach ($ids as $category => $imageIds) {
            $result[$category] = json_encode($imageIds);
        }

        file_put_contents('ids.txt', var_export($result, true));

        echo PHP_EOL . 'See ids.txt' . PHP_EOL . PHP_EOL;
    }

    /**
     * Возвращает количество картинок.
     * @return int
     */
    protected function getFileCount() {
        $dir = opendir(IMG_1920x1080);
        $count = 0;
        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $count++;
        }
        return $count;
    }

    /**
     * Карта источников картинок. Все должны быть 1920х1080
     * @return array
     */
    private function getUrlMap() {
        return [
            CollectionCategory::NATURE => [
//                'http://bestinspired.com/wp-content/uploads/2015/05/Nature-Wallpaper2.jpg',
//                'http://thewowstyle.com/wp-content/uploads/2015/01/3d-abstract_widewallpaper_nature-frame_47491.jpg',
//                'http://gardens.az/gardens/upload/Image/blue-water-green-nature.jpg',
//                'http://7-themes.com/data_images/out/61/6978845-nature-art-hd-wallpaper.jpg',
//                'http://hamderser.dk/blog/images/clairvoyant/clairvoyant-nature-nature5.jpg',
//                'http://www.accounting-ukraine.kiev.ua/img/green_business.jpg',
//                'http://vedski-jyotish.net/wp-content/uploads/2014/09/0001.jpg',
//                'http://imgscenter.com/images/2014/09/13/6-autumn-nature-sandbox-images_2053316.jpg',
            ],
            CollectionCategory::ANIMAL => [
//                'http://a2zhdwallpapers.com/wp-content/uploads/ktzbulkwallpaper-1425518873/animal-bird_00214719.jpg',
//                'http://feelgrafix.com/data_images/out/1/735859-animal-wallpapers.jpg',
//                'http://www.zastavki.com/pictures/originals/2013/Animals___Rodents___Animal_Echidna_from_South_Australia_043332_.jpg',
//                'http://cdn.playbuzz.com/cdn/279428ca-ddfa-45ce-87b5-53b20c6f3b38/ac4084b3-f55b-4332-83c9-0d411095e812.jpg',
//                'http://www.kelamayi.com.cn/xxtd/attachement/jpg/site2/20140224/00123f7adf371475619354.jpg',
//                'http://discover10.com/wp-content/uploads/2015/04/beautiful-animal-eyes-eyes-34592648-1920-1080.jpg',
            ],
            CollectionCategory::CAR    => [
//                'http://thewowstyle.com/wp-content/uploads/2015/04/car1.jpg',
//                'http://cdn.playbuzz.com/cdn/05de2551-1da8-4e1a-8621-fb82584d4c06/3d9b8f89-a1d7-488f-84e1-3f5e9093a232.jpg',
//                'http://pozadine.info/wp-content/uploads/2013/09/Dacia-Duster-koncept.jpg',
//                'http://cdn2.hubspot.net/hub/1212/file-27322445-jpg/images/classic_car2.jpg',
//                'http://freedwallpaper.com/wp-content/uploads/2014/03/1-nice-sports-car-resolution-unique-high_357127.jpg',
            ],
            CollectionCategory::SPACE  => [
//                'http://www.hdwallpapersos.com/wp-content/uploads/2014/08/8589130456914-outer-space-earth-digital-art-wallpaper-hd.jpg',
//                'http://exactpredictions.com/wp-content/uploads/2014/06/slide2.jpg',
//                'http://images6.fanpop.com/image/photos/33400000/space-colors-space-33432401-1920-1080.jpg',
//                'http://cdn.wonderfulengineering.com/wp-content/uploads/2014/04/space-wallpapers-6.jpg',
//                'http://7-themes.com/data_images/out/47/6932033-space-background-25628.jpg',
//                'http://feelgrafix.com/data_images/out/15/892006-space-wallpaper.jpg',
//                'http://cdn.geekwire.com/wp-content/uploads/2015/03/Earth-From-Space-Space-1080x1920.jpg',
//                'http://fc04.deviantart.net/fs70/f/2014/053/6/5/free_space_galaxy_texture_by_lyshastra-d77gh18.jpg',
//                'http://www.wallbeep.com/wp-content/uploads/2015/04/bright-dust-of-space.jpg',
//                'http://amzwall.com/wp-content/uploads/2015/02/Space-Picture-Desktop.jpg',
            ],
            CollectionCategory::GIRL   => [
//                'http://www.zastavki.com/pictures/originals/2014/Girls___Beautyful_Girls_Beautiful_eyelashes_girl_080971_.jpg',
//                'http://www.pageresource.com/wallpapers/wallpaper/jennifer-lamiraqui-christmas-girl-christms.jpg',
//                'http://www.blirk.net/wallpapers/1920x1080/girl-wallpaper-26.jpg',
//                'http://www.backgroundwallpapershd.com/wp-content/uploads/2014/01/14975-elisandra-tomacheski-1920x1080-girl-wallpaper.jpg',
//                'http://7-themes.com/data_images/out/52/6948182-cool-girl-with-gun.jpg',
//                'http://bestinspired.com/wp-content/uploads/2015/05/beautiful-girl-wallpapers.jpg',
//                'http://img.inspiringwallpapers.net/wp-content/uploads/2014/06/pretty-summer-girl.jpg',
//                'http://7-themes.com/data_images/out/75/7030450-miranda-kerr-smile-girl.jpg',
//                'http://thewowstyle.com/wp-content/uploads/2015/03/Beautiful-girl-wallpaper.jpg',
//                'http://uzone.id/wp-content/uploads/2015/06/gaulgelaa.jpg',
            ],
        ];
    }
}
