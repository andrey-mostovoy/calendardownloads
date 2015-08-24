<?php
namespace App\Collection;

/**
 * Класс описания коллекции машин.
 * @author Andrey Mostovoy <stalk.4.me@gmail.com>
 */
class CollectionCar implements CollectionInterface {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Машины';
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
            15,16,17,18,
            703,704,705,706,707,708,709,710,711,712,713,714,715,716,717,718,719,720,721,722,723,724,725,726,727,728,
            729,730,731,732,733,734,735,736,737,738,739,740,741,742,743,744,745,746,747,748,749,750,751,752,753,754,755,756,757,758,759,760,761,762,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,780,781,782,783,784,785,786,787,788,789,790,791,792,793,794,795,796,797,798,799,800,801,802,

        ];
    }
}
