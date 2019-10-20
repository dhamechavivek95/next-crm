function copyFirstName()
{
	var firstName = $('#contact-first_name').val();
	$('#contact-display_name').val(firstName);

}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
    && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function copyLastName()
{
	var firstName = $('#contact-first_name').val();
	var lastName = $('#contact-last_name').val();
	$('#contact-display_name').val(firstName+" "+lastName);

}

$(document).ready(function(){

	$('.start-date').datepicker({
           format: 'dd-mm-yyyy'
      }); 

	if ($(".select2").length) {
        $(".select2").select2({
            width: '100%'
        });
    }


$(document).on('click','.navbar-toggle',function(){
	if($('aside').hasClass('collapsed')){
		var eachIcon = $('aside').find('i.ion-ios7-arrow-down');
		$.each(eachIcon,function(index,value){
			$(value).removeClass('ion-ios7-arrow-down');
		})
	}else{
		var eachIcon = $('aside').find('i.pull-right');
		$.each(eachIcon,function(index,value){
			$(value).addClass('ion-ios7-arrow-down');
		})
	}
})

	setTimeout(function() {
    	$('.notifyjs-container').fadeOut('slow');
	}, 5000);
});

