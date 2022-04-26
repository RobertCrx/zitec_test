(function ($) {
    $(document).ready(function () {

        $(document).on('change', '#brand,#color,#fuel', function (e) {
            e.stopPropagation();
            var selectedOptions = [];
			
            $(".primary-select option:selected").each(function(){
                var value = $(this).val();
                if ($.trim(value)) {
                    selectedOptions.push(value.trim());
                }
            });
			
		 	console.log(selectedOptions);
			$('#preload-ajax').addClass('active-loader');
			
            if(selectedOptions.length > 0){

                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: jQuery.param({
                        action: 'find_cars',
                        brand: selectedOptions[0],
						color: selectedOptions[1],
						fuel: selectedOptions[2],
                    }),
                    success: function (data) {
						console.log(data);
                        if (data) {
							
							setTimeout(function(){
								$('#preload-ajax').removeClass('active-loader');
								$('.general-content').html(data);
								$('.general-content').fadeIn(1000);
							},1000);
	
                        }
                        else {
                          
							setTimeout(function(){
								$('#preload-ajax').removeClass('active-loader');
								$('.general-content').html('No cars found.');
								$('.general-content').fadeIn(1000);
							},1000);
                        }
                    },
                    error: function (jqXHR, exception) {
                        if (jqXHR.status == 500) {
                            console.log('Internal error: ' + jqXHR.responseText);
							$('#preload-ajax').removeClass('active-loader');

                        } else {
                            console.log('Unexpected error.' + exception);
							$('#preload-ajax').removeClass('active-loader');
                        }
                    }


                });

            }
        });


    });
})(jQuery);