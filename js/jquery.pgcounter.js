(function($) {

    $.fn.pgcounter = function(options, callback) {
        var settings = {
            'value': null,
            'theme': null,
            'time': null
        };

        if (options) {
            $.extend(settings, options);
        }

        this_sel = $(this);

        var html = '';
        html += '<div id="counter" class="'+settings['theme']+'">';
        html += '<div id="count-1" class="counts"><div class="count-icon"></div></div>';
        html += '<div id="count-2" class="counts">';
        html += '<div id="countdown">';
        html += '<div id="numb"></div><span id="numb-span">ANTENDIMENTOS</span>';
        html += '</div>';
        html += '</div>';
        html += '<div id="count-3" class="counts">';
        html += '<div id="datenow"></div>';
        html += '</div>';
        html += '</div>';

        this_sel.html(html);
        
        function count_exec() {
            jQuery.get( "modules/mod_pgcounter/ajax/pgcounter.php", function(data){
                if (!isNaN(data)) {
                    this_sel.find('#numb').text(data);
                }
            });
        }

        //inicia o contador regressivo
        this_sel.find('#numb').text(settings['value']);
        interval = setInterval(count_exec, settings['time']+'000');
        
        //inicia a data atual
        dateInterval = setInterval(date_exec, 1000);

        function date_exec() {
            dateNow = dateTranslated();
            this_sel.find('#datenow').text(dateNow);
        }


        function dateTranslated() {
            var now = new Date();

            weekday = now.getDay();
            switch (weekday) {
                case 0:
                    weekday = 'Domingo';
                    break;
                case 1:
                    weekday = 'Segunda-Feira';
                    break;
                case 2:
                    weekday = 'Terça-Feira';
                    break;
                case 3:
                    weekday = 'Quarta-Feira';
                    break;
                case 4:
                    weekday = 'Quinta-Feira';
                    break;
                case 5:
                    weekday = 'Sexta-Feira';
                    break;
                case 6:
                    weekday = 'Sabado';
                    break;
            }

            day = String(now.getDate()).length !== 2 ? '0' + now.getDate() : now.getDate();

            month = now.getMonth() + 1;
            switch (month) {
                case 1:
                    month = 'Janeiro';
                    break;
                case 2:
                    month = 'Fevereiro';
                    break;
                case 3:
                    month = 'Março';
                    break;
                case 4:
                    month = 'Abril';
                    break;
                case 5:
                    month = 'Maio';
                    break;
                case 6:
                    month = 'Junho';
                    break;
                case 7:
                    month = 'Julho';
                    break;
                case 8:
                    month = 'Agosto';
                    break;
                case 9:
                    month = 'Setembro';
                    break;
                case 10:
                    month = 'Outubro';
                    break;
                case 11:
                    month = 'Novembro';
                    break;
                case 12:
                    month = 'Dezembro';
                    break;
            }

            year = now.getFullYear();

            hours = String(now.getHours()).length !== 2 ? '0' + now.getHours() : now.getHours();

            minutes = String(now.getMinutes()).length !== 2 ? '0' + now.getMinutes() : now.getMinutes();

            seconds = String(now.getSeconds()).length !== 2 ? '0' + now.getSeconds() : now.getSeconds();

            //offset = now.getTimezoneOffset() == 180?'GMT-0300 (Brasil)':'';

            fullDate = weekday + ', ' + day + ' de ' + month + ' de ' + year + ' ' + hours + ':' + minutes + ':' + seconds;

            return fullDate;
        }

        function parseBRDate(date) {
            dataArray = date.split('/');
            switch (dataArray[1]) {
                case '01':
                    dataArray[1] = 'January';
                    break;
                case '02':
                    dataArray[1] = 'February';
                    break;
                case '03':
                    dataArray[1] = 'March';
                    break;
                case '04':
                    dataArray[1] = 'April';
                    break;
                case '05':
                    dataArray[1] = 'May';
                    break;
                case '06':
                    dataArray[1] = 'June';
                    break;
                case '07':
                    dataArray[1] = 'July';
                    break;
                case '08':
                    dataArray[1] = 'August';
                    break;
                case '09':
                    dataArray[1] = 'September';
                    break;
                case '10':
                    dataArray[1] = 'October';
                    break;
                case '11':
                    dataArray[1] = 'November';
                    break;
                case '12':
                    dataArray[1] = 'December';
                    break;
            }

            newData = dataArray[0] + ' ' + dataArray[1] + ' ' + dataArray[2];
            return newData;

        }
    };
})(jQuery);