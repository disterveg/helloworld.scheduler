$(function () {
    /** Клик по блоку с отделениями  */
    const visitBlock = $('.visit_block');
    visitBlock.click(function () {
        const department = $(this).data('department');
        visitBlock.removeClass("active_link");
        $(this).addClass('active_link');

        if (department !== undefined) {
            showList(department);
        }
    });
    /** Отображение календаря со списком талонов */
    function showList(department) {
        const loadSpinner = $('.loader_spinner');
        componentParameters.DEPARTMENT_ID = department;
        $.ajax({
            url: componentParameters.COMPONENT_ROOT + '/list.php',
            dataType: 'html',
            type: 'POST',
            data: {
                PARAMETERS: componentParameters,
                sessid: BX.bitrix_sessid()
            },
            beforeSend: function () {
                $('.table-container').hide();
                loadSpinner.css('display', 'block');
            },
            success: function (response) {
                $('#list').html(response);
                loadSpinner.css('display', 'none');
                initDoctorList();
            },
            error: function () {
                $('#list').html('error ajax');
            }
        });
    }

    /** Инициализация слайдера */
    function initDoctorList() {
        const windowWidth = $(window).width();
        const docSlider = $('.doctor-slider');
        function initSlider() {
            const doctorSliderWidth = docSlider.width();
            let itemWidth = 0;
            if (windowWidth >= '992') {
                itemWidth = 5;
            }
            if (windowWidth <= '991' && windowWidth >= '768') {
                itemWidth = 3;
            }
            if (windowWidth <= '767' && windowWidth >= '501') {
                itemWidth = 3;
            }
            if (windowWidth <= '500') {
                itemWidth = 2;
            }
            docSlider.flexslider({
                animation: "slide",
                slideshow: false,
                animationLoop: false,
                itemWidth: doctorSliderWidth / itemWidth,
                directionNav: true,
                controlNav: false,
                move: 1
            });
        }

        /** Клик по блоку с талонами */
        const ticket = $('.ticket');
        ticket.click(function (e) {
            const specID = $(this).data('specialist');
            const date = $(this).data('date');
            const day = $(this).data('day');
            const section = $(this).data('section');

            ticket.removeClass("active_link");
            $(this).addClass('active_link');

            if (section !== undefined && specID !== undefined && date !== undefined && day !== undefined) {
                showTickets(section, specID, date, day);
            } else {
                $('.time-select').empty();
            }
        });

        /** Отображение талонов по временем */
        function showTickets(section, specID, date, day) {
            const spinner = $('.spinner');
            componentParameters.DEPARTMENT_ID = section;
            componentParameters.DOCTOR_ID = specID;
            componentParameters.DATE = date;
            componentParameters.DAY = day;
            $.ajax({
                url: componentParameters.COMPONENT_ROOT + '/times.php',
                dataType: 'html',
                type: 'POST',
                data: {
                    PARAMETERS: componentParameters,
                    sessid: BX.bitrix_sessid(),
                },
                beforeSend: function () {
                    $('.time-select-container').hide();
                    spinner.css('display', 'block');
                    $('.container-button_step-2').hide();
                },
                success: function (response) {
                    $('#times').html(response);
                    spinner.css('display', 'none');
                    $('.container-button_step-2').show();
                    initTimes();
                },
                error: function () {
                    $('#times').html('error ajax');
                }
            });
        }

        initSlider();

        /** Клик по талону со временем */
        function initTimes() {
            const blockTime = $('.card-block_time');
            blockTime.click(function () {
                const time = $(this).data('time');
                const cardId = $(this).data('card-id');
                blockTime.removeClass("active_link");
                $(this).addClass('active_link');
                if($(this).hasClass("active_link")){
                    $('.visit_title').removeClass('error');
                    $('.btn-default.submit').removeClass('confirm-input');
                } else {
                    $('.btn-default.submit').addClass('confirm-input');
                }

                $('input[name="TIME"]').val(time);
                $('input[name="CARD_ID"]').val(cardId);
            });
        }
    }
});