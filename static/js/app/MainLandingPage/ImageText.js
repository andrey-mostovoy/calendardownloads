/**
 * Конструктор элемента текста на изображении.
 * @param {string} text
 * @constructor
 */
function ImageText (text) {
    /**
     * @type {null} jQuery объект элемента.
     */
    this.el = null;

    /**
     * @type {string} Ид элемента дома.
     */
    this.id = '';

    /**
     * @type {string} Текст.
     */
    this.text = text;

    /**
     * @type {string} Цвет.
     */
    this.color = '000';

    /**
     * @type {number} Размер шрифта, в пунктах pt.
     */
    this.fontSize = 22;

    /**
     * @type {number} Абсолютное значение по оси X.
     */
    this.x = 0;

    /**
     * @type {number} Абсолютное значение по оси Y.
     */
    this.y = 0;

    /**
     * @type {number} Относительное значение по оси X.
     */
    this.relativeX = 0;

    /**
     * @type {number} Относительное значение по оси Y.
     */
    this.relativeY = 0;

    /**
     * @type {number} Угол поворота относительно центра в радианах.
     */
    this.angle = 0;

    this.setUniqueId();
}

/**
 * Устанавливает уникальный идентификатор.
 */
ImageText.prototype.setUniqueId = function() {
    var x = 7,
        s = '';

    while (s.length < x && x > 0){
        var r = Math.random();
        s += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
    }

    this.id = s;
};

/**
 * Возвращает данные элемента текста на изображении.
 * @returns {Object}
 */
ImageText.prototype.getItemData = function() {
    return {
        'text': this.text,
        'fontSize': this.fontSize,
        'color': this.color,
        'x': this.x,
        'y': this.y,
        'relativeX': this.relativeX,
        'relativeY': this.relativeY,
        'angle': this.angle
    }
};
