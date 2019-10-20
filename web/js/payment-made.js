(function (factory) {
  'use strict';
  factory(window.jQuery);
}(function ($) {
  'use strict';
  $.widget("nextcrm.getBills", {
    _create: function () {
      var self = this;

      $.proxy(self.initializeVariables, self)();
      $.proxy(self.fetchBills, self)();
      $.proxy(self.changePaymentType, self)();
      $.proxy(self.amountTotal, self)();
      $.proxy(self.tbodyRows, self)();
    },  
    initializeVariables: function(){
      var self = this;
      self.amount = $('#paymentdetails-amount');
    },
    triggerKeyup: function(trElement){
      trElement.trigger('keyup');
    },
    changePaymentType: function(){
      var self = this;
      var paymentTypeValue = $('#paymentdetails-payment_type').val();
      self.chequeDetails = $('#cheque-details');
      self.netBankDetails = $('#netbank-details');

      switch(paymentTypeValue){
          case 'CASH':
          case 'CARD':
          self.chequeDetails.css('display','none');
          self.netBankDetails.css('display','none');
          break;
          case 'CHEQUE': 
          self.chequeDetails.css('display','block');
          self.netBankDetails.css('display','none');
          break;
          case 'NET BANKING':
          self.chequeDetails.css('display','none');
          self.netBankDetails.css('display','block');
          break;
          default:
          self.chequeDetails.css('display','none');
          self.netBankDetails.css('display','none');
          break;

        }

      $(document).on('change','#paymentdetails-payment_type',function(e){
        var paymentType = e.target.value;
        switch(paymentType){
          case 'CASH':
          case 'CARD':
          self.chequeDetails.css('display','none');
          self.netBankDetails.css('display','none');
          break;
          case 'CHEQUE': 
          self.chequeDetails.css('display','block');
          self.netBankDetails.css('display','none');
          break;
          case 'NET BANKING':
          self.chequeDetails.css('display','none');
          self.netBankDetails.css('display','block');
          break;
          default:
          self.chequeDetails.css('display','none');
          self.netBankDetails.css('display','none');
          break;

        }
      });
    },
    fetchBills: function(){
      var self = this;

      $(document).on('change','#paymentdetails-user_id',function(e){
        self.amount.val('');
        var user_id = e.target.value;
        $.post('fetch-bills',{user_id:user_id},function(response){
          self.totalAmount = 0;
          self.dueAmount = 0;
          var responseData = JSON.parse(response);
          self.jsonLength = responseData.length;
          var bodyHtml = '';
          if(responseData == ''){
            bodyHtml = "<tr><td>There are no bills applied for this payment.</td><tr>";
          }
          $.each(responseData,function(index,value){
            bodyHtml += "<tr><td hidden><input name='bill_id[]' value='"+value.bill_id+"' hidden></td><td class='date'>"+value.created_date+"</td><td class='bill_number'>"+value.bill_number+"</td><td class='amount'>"+value.amount+"</td><td class='due_amount'>"+value.due_amount+"</td><td class='payment col-sm-2'><input type='text' name='bill-payment[]' class='payment-input form-control' onkeypress='return isNumberKey(event)'></td></tr>";
            self.totalAmount +=  parseFloat(value.amount);              
            self.dueAmount +=  parseFloat(value.due_amount);              
          });
          $("#bodyData").html(bodyHtml);
        });
      });
    },
    amountTotal: function(){
      var self = this;
      $(document).on('keyup','#paymentdetails-amount',function(e){
        var paymentAmount = parseFloat(e.target.value);
        if(!isNaN(paymentAmount)){
          if(paymentAmount != 0){
            if(paymentAmount <= self.dueAmount){
              for(var i = 1; i <= self.jsonLength;i++){
                var newTr = $('#bodyData').find('tr:nth-child('+i+')');
                newTr.find('.payment-input').val(0);
                self.triggerKeyup(newTr.find('.payment-input'));
              }
              for(var i = 1; i <= self.jsonLength;i++){
                var newTr = $('#bodyData').find('tr:nth-child('+i+')');
                var due = newTr.find('td.due_amount').text();

                if(paymentAmount <= due){
                  newTr.find('.payment-input').val(paymentAmount);
                  self.triggerKeyup(newTr.find('.payment-input'));
                  break;
                } else if(paymentAmount > due){
                  newTr.find('.payment-input').val(due);
                  self.triggerKeyup(newTr.find('.payment-input'));
                  paymentAmount -= due;
                  continue;
                }
              }
            }else {
              self.amount.val(self.dueAmount);
              for(var i = 1; i <= self.jsonLength;i++){
                var newTr = $('#bodyData').find('tr:nth-child('+i+')');
                var due = newTr.find('td.due_amount').text();

                if(paymentAmount <= due){
                  newTr.find('.payment-input').val(paymentAmount);
                  self.triggerKeyup(newTr.find('.payment-input'));
                  break;
                } else if(paymentAmount > due){
                  newTr.find('.payment-input').val(due);
                  self.triggerKeyup(newTr.find('.payment-input'));
                  paymentAmount -= due;
                  continue;
                }
              }
            }
          }else{
            self.amount.val(0);
            for(var i = 1; i <= self.jsonLength;i++){
              var newTr = $('#bodyData').find('tr:nth-child('+i+')');
              newTr.find('.payment-input').val(0);
              self.triggerKeyup(newTr.find('.payment-input'));
            }
          }
        }else{
          self.amount.val('');
          for(var i = 1; i <= self.jsonLength;i++){
            var newTr = $('#bodyData').find('tr:nth-child('+i+')');
            newTr.find('.payment-input').val('');
            self.triggerKeyup(newTr.find('.payment-input'));
          }
        }
      });
    },
    tbodyRows: function(){
      var self = this;
      $(document).on('keyup','.payment-input',function(e){
        var allInput = $('#bodyData').find('td input.payment-input');
        var totalPayment = 0;
        $.each(allInput,function(index,val){
          // totalPayment += parseFloat(value);
          if(val.value == ''){
            val.value = 0;
          }
          totalPayment += parseFloat(val.value);
          $('#total-payment-made').text(totalPayment.toFixed(2));
          self.amount.val(totalPayment);
        });
        var payment = parseFloat(e.target.value);
        var dueAmount = parseFloat($(this).parent().prev('td.due_amount').text());
        if(!isNaN(payment)){
          if(payment != 0){
            if(payment <= dueAmount){
              $(this).val(payment);
            }else{
              $(this).val(dueAmount);
              self.triggerKeyup($(this));
            }
          }else{
            $(this).val(0);
          }
        }else{
          $(this).val('');
        }
      })
    },
  });
}));

$(document).ready(function () {
  $("#payment-made-active-form").getBills();
});