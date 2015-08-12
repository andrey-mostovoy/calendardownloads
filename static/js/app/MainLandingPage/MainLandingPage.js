/** @namespace App.MainLandingPage */
Core.createNamespace('App.MainLandingPage');

jQuery(document).ready(function() {
    var $body = jQuery('body'),
        Page = new App.MainLandingPage.MainLandingPage();

    $body.delegate('.js-save-button', 'click', jQuery.proxy(Page.onSave, Page));
    $body.delegate('.js-add-image-text', 'click', jQuery.proxy(Page.onCreateNewImageText, Page));
    $body.delegate('.js-del-image-text', 'click', jQuery.proxy(Page.onDeleteImageText, Page));
});

/**
 * Конструктор страницы.
 * @constructor
 */
App.MainLandingPage.MainLandingPage = function() {
    this.imageTextCollection = {};
};

/**
 * Обработчик события сохранения результата.
 * @param {Object} event
 */
App.MainLandingPage.MainLandingPage.prototype.onSave = function(event) {
    var items = [];
    for (var i in this.imageTextCollection) {
        if (!this.imageTextCollection.hasOwnProperty(i)) {
            continue;
        }

        items.push(this.imageTextCollection[i].getItemData());
    }

    if (!items.length) {
        console.error('No items to paste into image');
        return;
    }

    jQuery.ajax({
        type: 'post',
        data: {
            save: true,
            items: items,
            cat: Core.Data.get('category'),
            img: Core.Data.get('image')
        },
        success: function(response) {
            console.log(arguments);

            window.location.href = window.location.href + '?download=' + response.id;
        }
    });
};

/**
 * Обработчик события добавления нового текста на изображение.
 * @param {Object} event
 */
App.MainLandingPage.MainLandingPage.prototype.onCreateNewImageText = function(event) {
    var $form = jQuery(event.target).parents('.control').eq(0),
        $text = $form.find('input[name=text]'),
        $color = $form.find('input[name=color]'),
        $fontSize = $form.find('select[name=fontSize]');

    if (!$text.val()) {
        console.error('text is empty');
        return;
    }

    var ImageText = new window.ImageText($text.val());
    ImageText.color = $color.val();
    ImageText.fontSize = $fontSize.val();

    this.imageTextCollection[ImageText.id] = ImageText;

    // строим новые элементы
    var $wrapper = jQuery('<div/>').prop('id', ImageText.id).addClass('draggable').addClass('imageText'),
        $close = jQuery('<div/>').addClass('close').addClass('js-del-image-text').text('x'),
        $rotatable = jQuery('<div/>').addClass('rotatable').text(ImageText.text);

    if (ImageText.color) {
        $rotatable.css({
            'color': ImageText.color
        });
    }

    if (ImageText.fontSize) {
        $rotatable.css({
            'fontSize': ImageText.fontSize
        });
    }

    $rotatable.append($close);
    $wrapper.append($rotatable);

    ImageText.el = $wrapper;

    // добавляем элементы в дом
    jQuery('.imageWrapper').append($wrapper);

    var getPixelsByAngle = function(originalX, originalY, width, height, newAngle) {
        var x = originalX,
            y = originalY,
            halfWidth = width / 2,
            halfHeight = height / 2,
            angle = newAngle;

        return {
            'upperLeft': {
                'left': x - (halfWidth) * Math.cos(angle) + (halfHeight) * Math.sin(angle) + halfWidth,
                'top': y - (halfHeight) * Math.cos(angle) - (halfWidth) * Math.sin(angle) + halfHeight
            },
            'upperRight': {
                'left': x + (halfWidth) * Math.cos(angle) + (halfHeight) * Math.sin(angle) + halfWidth,
                'top': y - (halfHeight) * Math.cos(angle) + (halfWidth) * Math.sin(angle) + halfHeight
            },
            'bottomRight': {
                'left': x + (halfWidth) * Math.cos(angle) - (halfHeight) * Math.sin(angle) + halfWidth,
                'top': y + (halfHeight) * Math.cos(angle) + (halfWidth) * Math.sin(angle) + halfHeight
            },
            'bottomLeft': {
                'left': x - (halfWidth) * Math.cos(angle) - (halfHeight) * Math.sin(angle) + halfWidth,
                'top': y + (halfHeight) * Math.cos(angle) - (halfWidth) * Math.sin(angle) + halfHeight
            }
        }
    };

    var rotatableParams = {
        stop: function(event, ui) {
            ImageText.angle = ui.api.elementCurrentAngle;

            var offset = ui.api.getElementOffset(),
                wrapperPosition = jQuery('.imageWrapper').position(),
                pixels = getPixelsByAngle(offset.left, offset.top, ui.element.width(), ui.element.height(), ui.angle.current);

            ImageText.relativeX = pixels.upperLeft.left - wrapperPosition.left;
            ImageText.relativeY = pixels.upperLeft.top - wrapperPosition.top;
        }
    };
    var draggableParams = {
        cursor: 'move',
        containment: 'parent',
        stop: function(event, ui) {
            ImageText.x = ui.offset.left;
            ImageText.y = ui.offset.top;

            var wrapperPosition = jQuery('.imageWrapper').position(),
                pixels = getPixelsByAngle(ImageText.x, ImageText.y, ImageText.el.width(), ImageText.el.height(), ImageText.angle);
            ImageText.relativeX = pixels.upperLeft.left - wrapperPosition.left;
            ImageText.relativeY = pixels.upperLeft.top - wrapperPosition.top;
        }
    };
    var resizableParams = {
        aspectRatio: true,
        handles: 'ne, se, sw, nw'
    };

    // навешиваем на новые элементы обработчики
    $wrapper.draggable(draggableParams);
    //$target.resizable(resizableParams);
    $rotatable.rotatable(rotatableParams);

    //очищаем форму
    $text.val('');
    //$color.val('');
    //$fontSize.val('');
};

/**
 * Обработчик события удаления текста на изображение.
 * @param {Object} event
 */
App.MainLandingPage.MainLandingPage.prototype.onDeleteImageText = function(event) {
    var $target = jQuery(event.target).parents('.imageText').eq(0),
        id = $target.prop('id');

    delete this.imageTextCollection[id];

    $target.remove();
};
