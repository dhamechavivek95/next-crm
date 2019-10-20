(function (factory) {
    'use strict';
    factory(window.jQuery);
}(function ($) {
    'use strict';
    $.widget("nextcrm.invoice", {
        _create: function () {
            var self = this;

            self.totalAmount = $('#total-amount');
            // $.proxy(self.initElements, self)();
            $.proxy(self.addItem, self)();
            $.proxy(self.removeItem, self)();
            $.proxy(self.fetchItem, self)();
            $.proxy(self.lengthCal, self)();
            $.proxy(self.widthCal, self)();
            $.proxy(self.quantityCal, self)();
            $.proxy(self.calculatePrice, self)();
            $.proxy(self.calculateTotalAmount, self)();
            // $.proxy(self.mainDate, self)();
            // $.proxy(self.addDate, self)();
            // $.proxy(self.removeDate, self)();
            $.proxy(self.addExtraItem, self)();
            $.proxy(self.removeExtraItem, self)();
            $.proxy(self.extraQuantityCal, self)();
            $.proxy(self.extraTotalCal, self)();
            $.proxy(self.extraPriceCal, self)();

            $.proxy(self.appendItemErrors, self)();
            $.proxy(self.appendExtraItemErrors, self)();


            // $.proxy(self.mainTime, self)();
            // $.proxy(self.addTime, self)();
            // $.proxy(self.removeTime, self)();

            // $.proxy(self.mainDateTime, self)();
            // $.proxy(self.addDateTime, self)();
            // $.proxy(self.removeDateTime, self)();

            // $.proxy(self.intializeDateTime, self)();
            // $.proxy(self.weekdays, self)();
            // $.proxy(self.appendDateErrors, self)();
            // $.proxy(self.appendTimeErrors, self)();
            // $.proxy(self.appendHolidayErrors, self)();
        },

        initElements: function(){
            $('.start-date').datepicker({
             format: 'dd-mm-yyyy'
         }); 
/*
            if ($(".select2-cust").length) {
                $(".select2-cust").select2({
                    width: '100%'
                });
            }*/
        },

        triggerKeyup: function(element){
            element.trigger('keyup');
        },

        addItem: function(){
            var self = this;   
            $('.hidden-items').css('display', 'none');         
            $(document).on('click', '#addItem', function (e) {
                $('#append-items').append($('.hidden-items').html());
                $('#append-items').each(function () {
                    var length = $('.each-item', $(this)).length;
                    if (length > 1) {
                        $('#removeItem').show();
                    }
                });
                $('#append-items').each(function () {
                    var length = $('.each-item', $(this)).length;
                    if (length === 1) {
                        $('#removeItem').hide();
                    }
                });
                self.initElements();
            });
        },
        removeItem: function () {
            var self = this;
            $(document).on('click', '.removeItemBtn', function (e) {
                var eachElement = e.target.closest('.each-item');
                e.target.closest('.each-item').remove();
                $(".each-item").last().show();
                /*$('#append-items').each(function () {
                    var length = $('.each-item', $(this)).length;
                    if (length > 1) {
                        $('#removeItem').show();
                    }
                });
                $('#append-items').each(function () {
                    var length = $('.each-item', $(this)).length;
                    if (length === 1) {
                        $('#removeItem').hide();
                    }
                });*/
                self.initElements();
                self.triggerKeyup($('#append-items').find('.each-item:first').find('input.total_price_in'));
                self.triggerKeyup($('#append-extra-items').find('.each-extra-item:first').find('input.extra_total_rate_in'));
            });
        },

        fetchItem: function(){
            var self = this;
            $(document).on('change', '.fetch-items', function (e) {
                var eachElement = e.target.closest('.each-item');
                var item_id = e.target.value;
                if(!item_id){
                    $(eachElement).find('.description_in').val('');
                    $(eachElement).find('.price_in').val('');
                }
                $.get('fetch-data?id='+item_id,function(response){
                    var data = JSON.parse(response);
                    $(eachElement).find('.description_in').val(data.item_desc);
                    $(eachElement).find('.price_in').val(data.sales_rate);
                    self.triggerKeyup($(eachElement).find('.price_in'));
                });
            });
        },

        lengthCal: function(){
            var self = this;
            $(document).on('keyup','.length_in',function(e){
                var length = e.target.value;
                var eachElement = e.target.closest('.each-item');
                var width = $(eachElement).find('.width_in').val();
                var quantity = $(eachElement).find('.quantity_in').val();
                if(length && width && quantity){
                    var totalSqFeet = self.performCalc(length,width,quantity);
                    $(eachElement).find('.total_size_in').val(totalSqFeet);
                    self.triggerKeyup($(eachElement).find('input.price_in'));
                    self.triggerKeyup($(eachElement).find('input.total_price_in'));
                }
            });
        },
        widthCal: function(){
            var self = this;
            $(document).on('keyup','.width_in',function(e){
                var width = e.target.value;
                var eachElement = e.target.closest('.each-item');
                var length = $(eachElement).find('.length_in').val();
                var quantity = $(eachElement).find('.quantity_in').val();
                if(length && width && quantity){
                    var totalSqFeet = self.performCalc(length,width,quantity);
                    $(eachElement).find('.total_size_in').val(totalSqFeet);
                    self.triggerKeyup($(eachElement).find('input.price_in'));
                    self.triggerKeyup($(eachElement).find('input.total_price_in'));
                }
            });
        },
        quantityCal: function(){
            var self = this;
            $(document).on('keyup','.quantity_in',function(e){
                var quantity = e.target.value;
                var eachElement = e.target.closest('.each-item');
                var length = $(eachElement).find('.length_in').val();
                var width = $(eachElement).find('.width_in').val();
                if(length && width && quantity){
                    var totalSqFeet = self.performCalc(length,width,quantity);
                    $(eachElement).find('.total_size_in').val(totalSqFeet);
                    self.triggerKeyup($(eachElement).find('input.price_in'));
                    self.triggerKeyup($(eachElement).find('input.total_price_in'));
                }
            });
        },
        performCalc: function(length,width,quantity){
            var self = this;
            var lengthInFeet = parseFloat(parseInt(length)/12).toFixed(2);
            var widthInFeet = parseFloat(parseInt(width)/12).toFixed(2);
            var convertedLength = self.convertToNearest(lengthInFeet);
            var convertedWidth = self.convertToNearest(widthInFeet);
            var totalSqFeet = convertedLength * convertedWidth * quantity;
            return totalSqFeet;
        },
        convertToNearest: function(value){
            var decimalValue = parseInt(value.toString().split(".")[0]);
            var floatValue = value.toString().split(".")[1];
            if(floatValue > 0 && floatValue <= 25){
                floatValue = '25';
            }else if(floatValue > 25 && floatValue <= 50){
                floatValue = '50';
            }else if(floatValue > 50 && floatValue <= 75){
                floatValue = '75';
            }else if(floatValue > 75 && floatValue <= 99){
                floatValue = '00';
                decimalValue += 1;
            }
            return decimalValue+'.'+floatValue;
        },
        calculatePrice: function(){
            var self = this;
            $(document).on('keyup','.price_in',function(e){
                var price = e.target.value;
                var eachElement = e.target.closest('.each-item');
                var totalSqFeet = $(eachElement).find('.total_size_in').val();
                
                if(price && totalSqFeet){
                    var totalPrice = (parseFloat(price) * parseFloat(totalSqFeet)).toFixed(2);
                    $(eachElement).find('.total_price_in').val(totalPrice);
                    self.triggerKeyup($(eachElement).find('input.total_price_in'));
                }
            });
        },

        addExtraItem: function(){
            var self = this;   
            $('.hidden-extra-items').css('display', 'none');         
            $(document).on('click', '#addExtraItem', function (e) {
                $('#append-extra-items').append($('.hidden-extra-items').html());
                self.initElements();
            });
        },
        removeExtraItem: function () {
            var self = this;
            $(document).on('click', '.removeExtraItemBtn', function (e) {
                e.target.closest('.each-extra-item').remove();
                $(".each-extra-item").last().show();
                self.initElements();
                self.triggerKeyup($('#append-items').find('.each-item:first').find('input.total_price_in'));
                self.triggerKeyup($('#append-extra-items').find('.each-extra-item:first').find('input.extra_total_rate_in'));
            });
        },

        extraQuantityCal: function(){
            var self = this;
            $(document).on('keyup','.extra_quantity_in',function(e){
                var quantity = e.target.value;
                var eachElement = e.target.closest('.each-extra-item');
                var totalSize = $(eachElement).find('.extra_total_size_in').val();
                var extraPrice = $(eachElement).find('.extra_rate_in').val();
                if(totalSize && extraPrice && quantity){
                    var totalPrice = self.performExtraCal(quantity,totalSize,extraPrice);
                    $(eachElement).find('.extra_total_rate_in').val(totalPrice);
                    self.triggerKeyup($(eachElement).find('input.extra_total_rate_in'));
                }
            });
        },

        extraTotalCal: function(){
            var self = this;
            $(document).on('keyup','.extra_total_size_in',function(e){
                var totalSize = e.target.value;
                var eachElement = e.target.closest('.each-extra-item');
                var quantity = $(eachElement).find('.extra_quantity_in').val();
                var extraPrice = $(eachElement).find('.extra_rate_in').val();
                if(totalSize && extraPrice && quantity){
                    var totalPrice = self.performExtraCal(quantity,totalSize,extraPrice);
                    $(eachElement).find('.extra_total_rate_in').val(totalPrice);
                    self.triggerKeyup($(eachElement).find('input.extra_total_rate_in'));
                }
            });
        },

        extraPriceCal: function(){
            var self = this;
            $(document).on('keyup','.extra_rate_in',function(e){
                var extraPrice = e.target.value;
                var eachElement = e.target.closest('.each-extra-item');
                var quantity = $(eachElement).find('.extra_quantity_in').val();
                var totalSize = $(eachElement).find('.extra_total_size_in').val();
                if(totalSize && extraPrice && quantity){
                    var totalPrice = self.performExtraCal(quantity,totalSize,extraPrice);
                    $(eachElement).find('.extra_total_rate_in').val(totalPrice);
                    self.triggerKeyup($(eachElement).find('input.extra_total_rate_in'));
                }
            });
        },

        performExtraCal: function(quantity,totalSize,extraPrice){
            return (parseFloat(quantity) * parseFloat(totalSize) * parseFloat(extraPrice)).toFixed(2);
        },

        calculateTotalAmount: function(){
            var self = this;
            $(document).on('keyup','.total_price_in',function(e){
                var totalPayment = 0;
                var allItems = $('#append-items').find('input.total_price_in');
                $.each(allItems,function(index,val){
                  if(val.value == ''){
                    val.value = 0;
                }
                totalPayment += parseFloat(val.value);
                $('#total-item-amount').val((totalPayment).toFixed(2));
                self.saveTotalAmount();
            });
            });
            $(document).on('keyup','.extra_total_rate_in',function(e){
                var totalPayment = 0;
                var allExtraItems = $('#append-extra-items').find('input.extra_total_rate_in');
                $.each(allExtraItems,function(index,val){
                  if(val.value == ''){
                    val.value = 0;
                }
                totalPayment += parseFloat(val.value);
                $('#total-extra-item-amount').val((totalPayment).toFixed(2));
                self.saveTotalAmount();
            });
            });
        },

        saveTotalAmount: function(){
            var totalItemAmount = $('#total-item-amount').val();
            var totalExtraItemAmount = $('#total-extra-item-amount').val();
            if(totalItemAmount == ''){
                totalItemAmount = 0.00;
            }
            if(totalExtraItemAmount == ''){
                totalExtraItemAmount = 0.00;
            }
            $('#total-amount').val((parseFloat(totalItemAmount) + parseFloat(totalExtraItemAmount)).toFixed(2));
        },

        appendItemErrors: function () {
            var self = this;
            self.itemErrors = $.parseJSON($('#item-errors').text());

            $.each(self.itemErrors, function (index, value) {
                if (typeof value['date'] === "undefined")
                    value['date'] = '';
                if (typeof value['item_id'] === "undefined")
                    value['item_id'] = ''; 
                if (typeof value['length'] === "undefined")
                    value['length'] = '';
                if (typeof value['width'] === "undefined")
                    value['width'] = '';
                if (typeof value['quantity'] === "undefined")
                    value['quantity'] = '';
                if (typeof value['total_size'] === "undefined")
                    value['total_size'] = '';
                if (typeof value['rate'] === "undefined")
                    value['rate'] = '';
                if (typeof value['total_price'] === "undefined")
                    value['total_price'] = '';

                var date = '<div class="help-block help-block-error">' + value['date'] + '</div>';
                var items = '<div class="help-block help-block-error">' + value['item_id'] + '</div>';
                var length = '<div class="help-block help-block-error">' + value['length'] + '</div>';
                var width = '<div class="help-block help-block-error">' + value['width'] + '</div>';
                var quantity = '<div class="help-block help-block-error">' + value['quantity'] + '</div>';
                var total_size = '<div class="help-block help-block-error">' + value['total_size'] + '</div>';
                var rate = '<div class="help-block help-block-error">' + value['rate'] + '</div>';
                var total_price = '<div class="help-block help-block-error">' + value['total_price'] + '</div>';

                var i = 0;
                $('#append-items').find('.each-item').each(function () {
                    if (i == index) {
                        if (value['date'] != '') {
                            $(this).find('.date').addClass('has-error');
                            $(this).find('div.date-error').after(date);
                        }
                        if (value['items'] != '') {
                            $(this).find('.items').addClass('has-error');
                            $(this).find('div.items-error').after(items);
                        }
                        if (value['length'] != '') {
                            $(this).find('.size').addClass('has-error');
                            $(this).find('div.length-error').after(length);
                        }
                        if (value['width'] != '') {
                            $(this).find('.size').addClass('has-error');
                            $(this).find('div.width-error').after(width);
                        }
                        if (value['quantity'] != '') {
                            $(this).find('.quantity').addClass('has-error');
                            $(this).find('div.quantity-error').after(quantity);
                        }
                        if (value['total_size'] != '') {
                            $(this).find('.total_size').addClass('has-error');
                            $(this).find('div.total-size-error').after(total_size);
                        }
                        if (value['rate'] != '') {
                            $(this).find('.price').addClass('has-error');
                            $(this).find('div.price-error').after(rate);
                        }
                         if (value['total_price'] != '') {
                            $(this).find('.total-price').addClass('has-error');
                            $(this).find('div.total-price-error').after(total_price);
                        }
                        
                    }
                    i++;
                });
            });
        },

        appendExtraItemErrors: function(){
            var self = this;
            self.extraItemErros = $.parseJSON($('#extra-item-errors').text());

            $.each(self.extraItemErros, function (index, value) {
                if (typeof value['extra_date'] === "undefined")
                    value['extra_date'] = '';
                if (typeof value['extra_mold_image'] === "undefined")
                    value['extra_mold_image'] = ''; 
                if (typeof value['extra_description'] === "undefined")
                    value['extra_description'] = '';
                if (typeof value['extra_quantity'] === "undefined")
                    value['extra_quantity'] = '';
                if (typeof value['extra_total_size'] === "undefined")
                    value['extra_total_size'] = '';
                if (typeof value['extra_rate'] === "undefined")
                    value['extra_rate'] = '';
                if (typeof value['price'] === "undefined")
                    value['price'] = '';
                if (typeof value['extra_total_rate'] === "undefined")
                    value['extra_total_rate'] = '';

                var extra_date = '<div class="help-block help-block-error">' + value['extra_date'] + '</div>';
                var extra_mold_image = '<div class="help-block help-block-error">' + value['extra_mold_image'] + '</div>';
                var extra_description = '<div class="help-block help-block-error">' + value['extra_description'] + '</div>';
                var extra_quantity = '<div class="help-block help-block-error">' + value['extra_quantity'] + '</div>';
                var extra_total_size = '<div class="help-block help-block-error">' + value['extra_total_size'] + '</div>';
                var extra_rate = '<div class="help-block help-block-error">' + value['extra_rate'] + '</div>';
                var price = '<div class="help-block help-block-error">' + value['price'] + '</div>';
                var extra_total_rate = '<div class="help-block help-block-error">' + value['extra_total_rate'] + '</div>';

                var i = 0;
                $('#append-extra-items').find('.each-extra-item').each(function () {
                    if (i == index) {
                        if (value['extra_date'] != '') {
                            $(this).find('.extra_date').addClass('has-error');
                            $(this).find('div.extra_date-error').after(extra_date);
                        }
                        if (value['extra_mold_image'] != '') {
                            $(this).find('.extra_mold_image').addClass('has-error');
                            $(this).find('div.extra_mold_image-error').after(extra_mold_image);
                        }
                        if (value['extra_description'] != '') {
                            $(this).find('.extra_description').addClass('has-error');
                            $(this).find('div.extra_description-error').after(extra_description);
                        }
                        if (value['extra_quantity'] != '') {
                            $(this).find('.extra_quantity').addClass('has-error');
                            $(this).find('div.extra_quantity-error').after(extra_quantity);
                        }
                        if (value['extra_total_size'] != '') {
                            $(this).find('.extra_total_size').addClass('has-error');
                            $(this).find('div.extra_total_size-error').after(extra_total_size);
                        }
                        if (value['extra_rate'] != '') {
                            $(this).find('.extra_rate').addClass('has-error');
                            $(this).find('div.extra_rate-error').after(extra_rate);
                        }
                        if (value['extra_total_rate'] != '') {
                            $(this).find('.extra_total_rate').addClass('has-error');
                            $(this).find('div.extra_total_rate-error').after(extra_total_rate);
                        }
                        
                    }
                    i++;
                });
            });
        },

        intializeDateTime: function () {
            $('.datepicker').datepicker({
               format: 'yyyy-mm-dd'
           });
            $('.timepicker').timepicker({
                timeFormat: 'HH:mm:ss',
                minuteStep: 1,
                defaultTime: 'null',
            });
            $('.holidayDpicker').datepicker({
               format: 'yyyy-mm-dd'
           });
            $('.holidayTpicker').timepicker({
                timeFormat: 'HH:mm:ss',
                minuteStep: 1,
                defaultTime: 'null',
            });
        },
        weekdays: function () {
            $('select.weekdays').select2({
                width: '100%',
            });
        },


        mainDate: function () {
            var self = this;
            $('.hidden-dateslot').css('display', 'none');
            $('#office-hour-date-slot-id').each(
                function () {
                    var length = $('.each-dateslot', $(this)).length;
                    if (length === 1) {
                        $('#removeDate').hide();
                    }
                }
                );
            self.intializeDateTime();
        },
        addDate: function () {
            var self = this;
            $(document).on('click', '#addDate', function (e) {
                $('.officehour-dateslot').append($('.hidden-dateslot').html());
                $('#office-hour-date-slot-id').each(
                    function () {
                        var length = $('.each-dateslot', $(this)).length;
                        if (length > 1) {
                            $('#removeDate').show();
                        }
                    }
                    );
                $('#office-hour-date-slot-id').each(
                    function () {
                        var length = $('.each-dateslot', $(this)).length;
                        if (length === 1) {
                            $('#removeDate').hide();
                        }
                    }
                    );
                self.intializeDateTime();
            });
        },
        removeDate: function () {
            var self = this;
            $(document).on('click', '.removeDateBtn', function (e) {
                e.target.closest('.each-dateslot').remove();
                $(".each-dateslot").last().show();
                $('#office-hour-date-slot-id').each(
                    function () {
                        var length = $('.each-dateslot', $(this)).length;
                        if (length === 1) {
                            $('#removeDate').hide();
                        }
                    }
                    );
                self.intializeDateTime();
            });
        },

        mainTime: function () {
            var self = this;
            $('.hidden-timeslot').css('display', 'none');
            $('#office-hour-time-slot-id').each(
                function () {
                    var length = $('.each-timeslot', $(this)).length;
                    if (length === 1) {
                        $('#removeTime').hide();
                    }
                }
                );
            self.intializeDateTime();
        },
        addTime: function () {
            var self = this;
            var element = $('.hidden-timeslot').html();
            $(document).on('click', '#addTime', function (e) {
                $('.officehour-timeslot').append(element);
                $('#office-hour-time-slot-id').each(function () {
                    var length = $('.each-timeslot', $(this)).length;
                    if (length > 1) {
                        $('#removeTime').show();
                    }
                    var timeSlotElement = $('.each-timeslot',$(this)).find('.days');
                    timeSlotElement.each(function(i){
                        var child = $(this).find('.weekdays');
                        child.attr('name','run_on_days['+i+'][]');
                    })
                }
                );
                $('#office-hour-time-slot-id').each(function () {
                    var length = $('.each-timeslot', $(this)).length;
                    if (length === 1) {
                        $('#removeTime').hide();
                    }
                }
                );
                self.intializeDateTime();
                self.weekdays();
            });
        },
        removeTime: function () {
            var self = this;
            $(document).on('click', '.removeTimeBtn', function (e) {
                e.target.closest('.each-timeslot').remove();
                $(".each-timeslot").last().show();
                $('#office-hour-time-slot-id').each(
                    function () {
                        var length = $('.each-timeslot', $(this)).length;
                        if (length === 1) {
                            $('#removeTime').hide();
                        }
                        var timeSlotElement = $('.each-timeslot',$(this)).find('.days');
                        timeSlotElement.each(function(i){
                            var child = $(this).find('.weekdays');
                            child.attr('name','run_on_days['+i+'][]');
                        })
                    }
                    );
                self.intializeDateTime();
                self.weekdays();
            });
        },

        mainDateTime: function () {
            var self = this;
            $('.hidden-datetime').css('display', 'none');
            self.intializeDateTime();
        },
        addDateTime: function () {
            var self = this;
            $(document).on('click', '#addDateTime', function (e) {
                $('.holiday-datetime').append($('.hidden-datetime').html());
                self.intializeDateTime();
            });
        },
        removeDateTime: function () {
            var self = this;
            $(document).on('click', '.removeDateTimeBtn', function (e) {
                e.target.closest('.each-holiday-datetime').remove();
                $(".each-holiday-datetime").last().show();
                self.intializeDateTime();
            });
        },

        appendDateErrors: function () {
            var self = this;
            self.dateError = $.parseJSON($('#officehour-dateslot-errors').text());

            $.each(self.dateError, function (index, value) {
                if (typeof value['start_date'] === "undefined")
                    value['start_date'] = '';
                if (typeof value['end_date'] === "undefined")
                    value['end_date'] = '';

                var startError = '<div class="help-block help-block-error">' + value['start_date'] + '</div>';
                var endError = '<div class="help-block help-block-error">' + value['end_date'] + '</div>';

                var i = 0;
                $('.officehour-dateslot').find('.each-dateslot').each(function () {
                    if (i == index) {
                        if (value['start_date'] != '') {
                            $(this).find('.startdate').addClass('has-error');
                            $(this).find('div.startdate-error').after(startError);
                        }
                        if (value['end_date'] != '') {
                            $(this).find('.enddate').addClass('has-error');
                            $(this).find('div.enddate-error').after(endError);
                        }
                    }
                    i++;
                });
            });
        },

        appendTimeErrors: function () {
            var self = this;
            self.timeError = $.parseJSON($('#officehour-timeslot-errors').text());

            $.each(self.timeError, function (index, value) {
                if (typeof value['start_time'] === "undefined")
                    value['start_time'] = '';
                if (typeof value['end_time'] === "undefined")
                    value['end_time'] = '';
                if (typeof value['run_on_days'] === "undefined")
                    value['run_on_days'] = '';

                var startError = '<div class="help-block help-block-error">' + value['start_time'] + '</div>';
                var endError = '<div class="help-block help-block-error">' + value['end_time'] + '</div>';
                var dayError = '<div class="help-block help-block-error">' + value['run_on_days'] + '</div>';

                var i = 0;
                $('.officehour-timeslot').find('.each-timeslot').each(function () {
                    if (i == index) {
                        if (value['start_time'] != '') {
                            $(this).find('.starttime').addClass('has-error');
                            $(this).find('div.starttime-error').after(startError);
                        }
                        if (value['end_time'] != '') {
                            $(this).find('.endtime').addClass('has-error');
                            $(this).find('div.endtime-error').after(endError);
                        }
                        if (value['run_on_days'] != '') {
                            $(this).find('.days').addClass('has-error');
                            $(this).find('div.days-error').after(dayError);
                        }
                    }
                    i++;
                });
            });
        },

        appendHolidayErrors: function () {
            var self = this;
            self.holidayError = $.parseJSON($('#holiday-date-time-errors').text());

            $.each(self.holidayError, function (index, value) {
                if (typeof value['start_time'] === "undefined")
                    value['start_time'] = '';
                if (typeof value['end_time'] === "undefined")
                    value['end_time'] = '';

                var startTime = '<div class="help-block help-block-error">' + value['start_time'] + '</div>';
                var endTime = '<div class="help-block help-block-error">' + value['end_time'] + '</div>';

                var i = 0;
                $('.holiday-datetime').find('.each-holiday-datetime').each(function () {
                    if (i == index) {
                        if (value['start_time'] != '') {
                            $(this).find('.holidayStartDate').addClass('has-error');
                            $(this).find('div.holidayStartDate-error').after(startTime);
                        }
                        if (value['end_time'] != '') {
                            $(this).find('.holidayEndDate').addClass('has-error');
                            $(this).find('div.holidayEndDate-error').after(endTime);
                        }
                    }
                    i++;
                });
            });
        },
    });
}));

$(document).ready(function () {
    $("#invoice-active-form").invoice();
});