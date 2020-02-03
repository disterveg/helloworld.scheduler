$(function () {
    let circle, d, x, y;
    let i = 1;
    const queue = [];

    const confirmInput = $('#confirm-input');

    confirmInput.on('change', function () {
        checkConfirm();
    });

    $(document).on('click', '.btn-default.confirm-input', function (e) {
        showCheckboxError(e);
    });

    $(document).on('click', '.disabled-link', function (e) {
        e.preventDefault()
    });

    $(document).on('click', '.animate-click', function (e) {
        waveAnimation($(this), e);
    });

    function showCheckboxError (e) {
        e.preventDefault();
        $('.checkbox-custom').addClass('error');
    }

    const btnNext = $('.btn.btn-default.button-next');

    /** Проверяем чекбокс на согласие */
    function checkConfirm() {
        if(confirmInput.prop('checked')) {
            btnNext.removeClass('confirm-input');
            $('.control-panel__link.second .disabled-link').removeClass('disabled-link');
            $('.checkbox-custom').removeClass('error');
        } else {
            btnNext.addClass('confirm-input');
            $('.control-panel__link.second .control-panel__item').addClass('disabled-link');
        }
    }

    if($('.agreement-check #confirm-input').length !== 0) {
        checkConfirm();
    }

    /** Функция анимации */
    function waveAnimation(element, event) {
        if (queue.length > 5) {
            $("._" + queue.shift()).remove();
        }

        if (i > 1000) {
            i = 0;
        }

        i++;
        queue.push(i);

        element.append("<span class='circle _" + i + "'></span>");
        circle = element.find("._" + i);

        if(!circle.height() && !circle.width()) {
            d = Math.max(element.outerWidth(), element.outerHeight());
            circle.css({height: d, width: d});
        }

        x = event.pageX - element.offset().left - circle.width() / 2;
        y = event.pageY - element.offset().top - circle.height() / 2 ;

        circle.css({top: y+'px', left: x+'px'}).addClass("animate");
    }
});