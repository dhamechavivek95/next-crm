(function (factory) {
  'use strict';
  factory(window.jQuery);
}(function ($) {
  'use strict';
  $.widget("nextcrm.getItems", {
    _create: function () {
      var self = this;

      $.proxy(self.initilizeVariables, self)();
      $.proxy(self.addItems, self)();
      $.proxy(self.removeItem, self)();
      $.proxy(self.addSubCategory, self)();
      $.proxy(self.removeSubCategory, self)();
      $.proxy(self.calculateTotal, self)();
    },

    initilizeVariables: function () {
      var self = this;
      self.table = $('#datatable');
      $('#invoice-inv_date').datepicker({
           format: 'dd-mm-yyyy'
      }); 
      $('#invoice-expiry_date').datepicker({
           format: 'dd-mm-yyyy'
      }); 
    },
    calculateTotal: function () {
      self.table = $('#datatable');
      self.totalAmount = $('#total-amount').val();
      var mainTotal = $('tbody').find('td.total');
      var subTotal = $('tbody').find('td.sub-total');
      var total = 0;
      var sTotal = 0;
      $.each(mainTotal,function(index,value){
        total = parseFloat(total) + parseFloat($(value).text());         
      });

      $.each(subTotal,function(sIndex,sValue){
        sTotal = parseFloat(sTotal) + parseFloat($(sValue).text());         
      });

      var fullAmount = parseFloat(total) + parseFloat(sTotal);
      $('#total-amount').val(fullAmount.toFixed(2));
    },
    addItems: function () {
      var self = this;
      $(document).on('change','#add-item',function(e) {
        var item_id = e.currentTarget.value;

        $.post('fetch-item', {item_id: item_id}, function(response) {
          var responseData = JSON.parse(response);

          // var html = '<tr class="'+number+' main-cat"><td class="item-name"><a class="btn btn-sm add-sub-category" title="Add Extra Charges"><span class="ion-plus-circled"></span></a><input name="item-name[]" value="'+responseData.item_name+'" hidden/>'+responseData.item_name+'</td><td class="item-desc"><input name="item-desc[]" value="'+responseData.item_desc+'" hidden/>'+responseData.item_desc+'</td><td class="quantity-selected"><input name="quantity-selected[]" value="'+responseData.quantity_selected+'" hidden/>'+responseData.quantity_selected+'</td><td class="sales-rate"><input name="sales-rate[]" value="'+responseData.sales_rate+'" hidden/>'+responseData.sales_rate+'</td><td class="sales-account"><input name="sales-account[]" value="'+responseData.sales_account+'" hidden/>'+responseData.sales_account+'</td><td class="total"><input name="total[]" value="'+responseData.sales_account+'" hidden/>'+responseData.total+'<a class="btn btn-sm removeItemBtn" title="Remove Item"><span class="ion-android-close"></span></a></td> </tr>';
          var html = '<tr class="main-cat"><td class="item-name"><a class="btn btn-sm add-sub-category" title="Add Extra Charges"><span class="ion-plus-circled"></span></a>'+responseData.item_name+'</td><td class="item-desc">'+responseData.item_desc+'</td><td class="quantity-selected">'+responseData.quantity_selected+'</td><td class="sales-rate">'+responseData.sales_rate+'</td><td class="sales-account">'+responseData.sales_account+'</td><td class="total">'+responseData.total+'<a class="btn btn-sm removeItemBtn" title="Remove Item"><span class="ion-android-close"></span></a></td> </tr>';
          self.table.append(html);
          $('.item-desc').editable({
            type: 'textarea',
            url: '#',
          });
          $('.quantity-selected').editable({
            type: 'text',
            validate : function(value){
              var reg = /^[+-]?\d+(\.\d+)?$/;
              if(!reg.test(value)){
                return 'Value is invalid';
              }else if(value == 0){
                return 'Value must be greater than 0';
              }
            },
            success : function(i,val){
              var rateValue = $(this).siblings('td.sales-rate').text();
              var totalValue = parseFloat(val) * parseFloat(rateValue);
              $(this).siblings('td.total').text('').append(totalValue.toFixed(2)+'<a class="btn btn-sm removeItemBtn" title="Remove Item"><span class="ion-android-close"></span></a>');
              self.calculateTotal();
            }
          });
          $('.sales-rate').editable({
            type: 'text',
            validate : function(value){
              var reg = /^[+-]?\d+(\.\d+)?$/;
              if(!reg.test(value)){
                return 'Value is invalid';
              }else if(value == 0){
                return 'Value must be greater than 0';
              }
            },
            success : function(i,val){
              var quantityValue = $(this).siblings('td.quantity-selected').text();
              var totalValue = parseFloat(val) * parseFloat(quantityValue);
              $(this).siblings('td.total').text('').append(totalValue.toFixed(2)+'<a class="btn btn-sm removeItemBtn" title="Remove Item"><span class="ion-android-close"></span></a>');
              self.calculateTotal();
            }
          });
          $('.sales-account').editable({
            type: 'text',
            url: '#',
          });
          $('#add-item').val('');
          self.calculateTotal();
        });
      });
    },
    removeItem: function(){
      var self = this;
      $(document).on('click','.removeItemBtn',function(e){
        self.rowElement = $(this).parent().parent();
        var count = $(this).parent().parent().find('.item-name').attr('rowspan');
        for(var i = 0;i<count-1;i++){
          $(this).parent().parent().next('.sub-cat').remove();  
        }
        e.target.closest('tr').remove();
        self.calculateTotal();
      });
    },
    addSubCategory: function(){
      var self = this;
      $(document).on('click','.add-sub-category',function(e){
          self.tableRow = e.target.closest('tr');
          self.rowElement = $(this).parent().parent();
          var rowCount = $(this).closest('.item-name').attr('rowspan');
          var totalCount = self.rowElement.find('.total').attr('rowspan');
          var accountCount = self.rowElement.find('.sales-account').attr('rowspan');
          if(rowCount == undefined){
            $(this).closest('.item-name').attr('rowspan','2');
          }else{
            var rowUpdate = parseInt(rowCount) + 1;
            $(this).closest('.item-name').attr('rowspan',rowUpdate);
          }

          /*if(totalCount == undefined){
            self.rowElement.find('.total').attr('rowspan','2');
          }else{
            var totalUpdate = parseInt(rowCount) + 1;
            self.rowElement.find('.total').attr('rowspan',totalUpdate);
          }*/

          if(accountCount == undefined){
            self.rowElement.find('.sales-account').attr('rowspan','2');
          }else{
            var accountUpdate = parseInt(rowCount) + 1;
            self.rowElement.find('.sales-account').attr('rowspan',accountUpdate);
          }

          self.rowElement.after("<tr class='sub-cat'><td class='sub-desc'></td><td class='sub-quantity'>1</td><td class='sub-rate'>1</td><td class='sub-total'>1<a class='btn btn-sm remove-sub-cat' title='Remove Item'><span class='ion-android-close'></span></a></td></tr>");
          $('.sub-desc').editable({
            type: 'textarea',
            url: '#',
          });
          $('.sub-quantity').editable({
            type: 'text',
            validate : function(value){
              var reg = /^[+-]?\d+(\.\d+)?$/;
              if(!reg.test(value)){
                return 'Value is invalid';
              }else if(value == 0){
                return 'Value must be greater than 0';
              }
            },
            success : function(i,val){
              var subRateValue = $(this).siblings('td.sub-rate').text();
              var totalValue = parseFloat(val) * parseFloat(subRateValue);
              $(this).siblings('td.sub-total').text('').append(totalValue.toFixed(2)+'<a class="btn btn-sm remove-sub-cat" title="Remove Item"><span class="ion-android-close"></span></a>');
              self.calculateTotal();
            }
          });
          $('.sub-rate').editable({
            type: 'text',
            validate : function(value){
              var reg = /^[+-]?\d+(\.\d+)?$/;
              if(!reg.test(value)){
                return 'Value is invalid';
              }else if(value == 0){
                return 'Value must be greater than 0';
              }
            },
            success : function(i,val){
              var subQuantityValue = $(this).siblings('td.sub-quantity').text();
              var totalValue = parseFloat(val) * parseFloat(subQuantityValue);
              $(this).siblings('td.sub-total').text('').append(totalValue.toFixed(2)+'<a class="btn btn-sm remove-sub-cat" title="Remove Item"><span class="ion-android-close"></span></a>');
              self.calculateTotal();
            }
          });
          self.calculateTotal();
      });
    },
    removeSubCategory: function(){
      var self = this;
      $(document).on('click','.remove-sub-cat',function(e){
        self.tableRow = e.target.closest('tr');
        self.mainCategory = $(self.tableRow).prevAll('.main-cat:first');
        var rowCount = self.mainCategory.find('td.item-name').attr('rowspan');
        var accountCount = self.mainCategory.find('td.sales-account').attr('rowspan');
        var rowUpdate = parseInt(rowCount) - 1;
        self.mainCategory.find('td.item-name').attr('rowspan',rowUpdate);
        self.mainCategory.find('td.sales-account').attr('rowspan',rowUpdate);
        self.tableRow.remove();
        self.calculateTotal();
      });
    },
  });
}));

$(document).ready(function () {
  $("#invoice-active-form").getItems();

  $(document).on('beforeSubmit','#invoice-active-form',function(e){
      var form = $(this);
      var formData = $(this).serialize();
      var allTableData = $('tbody').find('tr');
      var mainCatData = {};
      var subCatData = {};
      var allData = {};
      $.each(allTableData,function(index,value){
        if(index == 0){
          return;
        }

        if($(value).attr('class') == 'main-cat'){
            mainCatData[index] = {};
        } else if($(value).attr('class') == 'sub-cat'){
          subCatData[index] = {};          
        }
        
        $.each(value.cells,function(tdIndex,tdValue){
          if($(value).attr('class') == 'main-cat'){
              mainCatData[index][$(tdValue).attr('class').split(' ')[0]] = $(tdValue).text();
          }else if($(value).attr('class') == 'sub-cat'){
              subCatData[index][$(tdValue).attr('class').split(' ')[0]] = $(tdValue).text();
          }
        });
        if($(value).attr('class') == 'main-cat'){
            allData['mainData'] = mainCatData;
        } else if($(value).attr('class') == 'sub-cat'){
          allData['subData'] = subCatData;
        }
      });

      var mergeData = {
            form : $(this).serialize(),
            other : allData
        };

      $.post('create',mergeData,function(response){
          if(response == true){
            window.location = 'index';
          }
      });
      return false;
  })

});