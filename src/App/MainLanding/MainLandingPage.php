<?php
namespace App\MainLanding;

use App\Image\Image;
use Core\Page\AbstractWebPage;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;

/**
 * Класс описания главной страницы.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class MainLandingPage extends AbstractWebPage {
    private $coeffX = 3.84;
    private $coeffY = 3.84;

    /**
     * {@inheritdoc}
     */
    public function run() {
        if (isset($_POST['save'])) {
            $this->handleSaveImage();
        }

        if (isset($_GET['download'])) {
            $this->handleDownloadImage();
        }

        $category = $this->getArg('category');
        $image = $this->getArg('image');

        $this->addToJs('category', $category);
        $this->addToJs('image', $image);
        $this->bind('workUrl', IMAGE_WORK_THUMB_PATH . Image::getName($category, $image));

        return true;
    }

    /**
     * Обработаем создание нового изображения для дальнейшего скачивания пользователем.
     */
    private function handleSaveImage() {
        $items = $_POST['items'];
        $category = $_POST['cat'];
        $image = $_POST['img'];
        $fileName = Image::getName($category, $image);

        $Palette = new RGB();
        $Imagine = new Imagine();

        $Image = $Imagine->open(IMG_1920x1080 . $fileName);

        foreach ($items as $item) {
            $text = $item['text'];
            $fontSize = $item['fontSize'];
            $x = $item['relativeX'];
            $y = $item['relativeY'];

            $sizedFontSize = ($fontSize * 1920) / 500;
            $sizedX = $this->coeffX * $x;
            $sizedY = $this->coeffY * $y;

            $Font = $Imagine->font(FONT_DIR . 'Arial.ttf', $sizedFontSize, $Palette->color($item['color']));
            $Position = new Point($sizedX, $sizedY);
            $angle = rad2deg($item['angle']);

            $Image->draw()->text($text, $Font, $Position, $angle);
        }

        $id = uniqid();
        $filePath = IMG_DOWNLOAD . $id . Image::EXTENSION;
        $Image->save($filePath);

        header('Content-Type: application/json; charset=utf8');
        echo json_encode(['id' => $id], JSON_UNESCAPED_UNICODE);

        exit();
    }

    /**
     * Отдаем юзеру готовое изображение.
     */
    private function handleDownloadImage() {
        $id = $_GET['download'];
        $fileDir = IMG_DOWNLOAD . $id . Image::EXTENSION;

        header('Cache-Control: public');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . basename($fileDir));
        header('Content-Type: ' . mime_content_type($fileDir));
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($fileDir));

        readfile($fileDir);

        unlink($fileDir);

        exit();
    }
}
