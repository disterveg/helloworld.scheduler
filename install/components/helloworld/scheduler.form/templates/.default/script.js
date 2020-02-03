$(function() {
    addValuesToMultiEnum();
    validationForm();

    if ($('input[name="site_key"]').length) {
        getRecaptcha();
    }

    /** Получаем токен рекапчи */
    function getRecaptcha(){
        grecaptcha.ready(function() {
            grecaptcha.execute($('input[name="site_key"]').val(), {action:'validate_captcha'})
                .then(function(token) {
                    $('#g-recaptcha-response').prop('value', token);
                });
        });
    }

    /** Добавляем значения к множественным спискам */
    function addValuesToMultiEnum() {
        $('.field-multi-enum').each(function () {
            const nameField = $(this).prop('name');
            const arrVal = [];
            $('.enum-checkboxes_' + nameField).on('click', function () {
                arrVal.push($(this).val());
                $('input[name="' + nameField + '"]').val(arrVal);
            });

        });
    }

    function validationForm() {
        const form = $("form[name='appointment-add']");
        form.validate( {
            rules: {
                UF_EMAIL: {
                    regexp: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                },
                UF_FIO: {
                    regexp: /^[A-Za-zА-Яа-я\s]+$/
                },
                UF_YEAR: {
                    date: true
                },
            }
        } );
        $.validator.addMethod(
            'regexp', function (value, element, regexp) {
                const re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            BX.message('JS_FORMAT')
        );
        $.validator.addMethod(
            "date",
            function(value) {
                const arrDate = value.split('.');
                const dd = arrDate[0];
                const mm = arrDate[1];
                const yy = arrDate[2];
                if(new Date(yy + '/' + mm + '/' + dd) >= new Date()){
                    return false;
                }
                if(new Date(yy + '/' + mm + '/' + dd).toString() !== 'Invalid Date'){
                    return value;
                } else {
                    return false;
                }
            },
            BX.message('JS_FORMAT')
        );
        $.extend($.validator.messages, {
            required: BX.message('JS_REQUIRED') ? BX.message('JS_REQUIRED') : 'Обязательное поле',
            email: BX.message('JS_FORMAT') ? BX.message('JS_FORMAT') : 'Неверный формат',
            remote: BX.message('JS_ERROR') ? BX.message('JS_ERROR') : 'Неверно заполнено поле'
        });
        submitForm(form);
    }

    /** Отправка формы */
    function submitForm(form) {
        form.on('submit', function (e) {
            if ($.isEmptyObject(form.validate().invalid)) {
                e.stopPropagation();
                e.preventDefault();
                const ser = form.serialize();
                $.ajax({
                    url: $('input[name="component_root"]').val() + '/ajax.php',
                    dataType: 'html',
                    type: 'POST',
                    data: ser,
                    success: function (response) {
                        if(response === 'SUCCESS') {
                            $('#third-step').html($('.success__form').addClass('active'));
                            $('html, body').animate({ scrollTop: $('.maxwidth-screen').offset().top - 100 }, 500);
                        } else if(response) {
                            $('.error__text').html(response);
                            getRecaptcha();
                        }
                    },
                    error: function () {
                        $('.error__text').html('error ajax');
                        getRecaptcha();
                    }
                });
            }
        });
    }

    /** Маски для инпутов */
    $('.control-panel__item.active').removeClass('disabled-link');
    $('#UF_PHONE').mask("+7 (999) 999-99-99");
    $('#UF_YEAR').mask("99.99.9999");
});