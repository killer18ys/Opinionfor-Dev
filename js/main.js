$( document ).ready(function() {

	$formInput = $( ".form-item input" );


	$formInput.on( "focusin", function( event ) {
		$this = $(this);
		if (!$this.val()) { //no value
			$this.siblings("label").css('opacity', '0.5');
		}
		else{
			$this.siblings("label").css('opacity', '0');
			$this.siblings("label").hide();
		};		
	});


	$formInput.on( "focusout", function( event ) {
		if (!$this.val()) { //no value
			$(this).siblings("label").show();
			$(this).siblings("label").css('opacity', '1');
		}
		else{
			$(this).siblings("label").hide();
			$(this).siblings("label").css('opacity', '0');
		}
	});
	
	$formInput.keydown(function() {
		if ($this.val() != "undefined") {
			$this.siblings("label").hide();
			$this.siblings("label").css('opacity', '0');
		}
	});

	$formInput.keyup(function(event) {
			if (event.keyCode == 9) {
				$this.siblings("label").css('transition', 'none');
			}else{		
				if (!$this.val()) {
					$this.siblings("label").css('opacity', '0.5');
					$this.siblings("label").show();
				};
			}
	});


	function onClickLoginModalShow(){
		$("#login-modal").show(700);
		$("#tarp").show();
	}

	function onClickLoginModalHide(){
		$("#login-modal").hide();
		$("#tarp").hide();
	}

	$("#main-header .btn.sign-up.pop-up").on('click', function(event) {
		event.preventDefault();
		onClickLoginModalShow();
	});

	$("#login-modal").on('mouseout', function(event) {
		$("#tarp").on('click', function(event) {
			onClickLoginModalHide();
		});
	});

	$("#login-modal .modal-close").on('click', function(event) {
			onClickLoginModalHide();
	});


	$('.logo-nav-line nav ul li.menu span.settings-gear ').on('click', function(event) {
		event.preventDefault();
		
		$('.logo-nav-line nav ul li.menu .header-menu').show();

		$('.logo-nav-line nav ul li.menu .header-menu').on('mouseleave', function(event) {
			event.preventDefault();
			$(this).hide();
		});

	});

		// Custom Select Start

		$('select').each(function () {

		    // Cache the number of options
		    var $this = $(this),
		        numberOfOptions = $(this).children('option').length;

		    // Hides the select element
		    $this.addClass('s-hidden');

		    // Wrap the select element in a div
		    $this.wrap('<div class="select"></div>');

		    // Insert a styled div to sit over the top of the hidden select element
		    $this.after('<div class="styledSelect"></div>');

		    // Cache the styled div
		    var $styledSelect = $this.next('div.styledSelect');

		    // Show the first select option in the styled div
		    $styledSelect.text($this.children('option').eq(0).text());

		    // Insert an unordered list after the styled div and also cache the list
		    var $list = $('<ul />', {
		        'class': 'options'
		    }).insertAfter($styledSelect);

		    // Insert a list item into the unordered list for each select option
		    for (var i = 0; i < numberOfOptions; i++) {
		        $('<li />', {
		            text: $this.children('option').eq(i).text(),
		            rel: $this.children('option').eq(i).val()
		        }).appendTo($list);
		    }

		    // Cache the list items
		    var $listItems = $list.children('li');

		    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
		    $styledSelect.click(function (e) {
		        e.stopPropagation();
		        $('div.styledSelect.active').each(function () {
		            $(this).removeClass('active').next('ul.options').hide();
		        });
		        $(this).toggleClass('active').next('ul.options').toggle();
		    });

		    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
		    // Updates the select element to have the value of the equivalent option
		    $listItems.click(function (e) {
		        e.stopPropagation();
		        $styledSelect.text($(this).text()).removeClass('active');
		        $this.val($(this).attr('rel'));
		        $list.hide();
		        /* alert($this.val()); Uncomment this for demonstration! */
		    });

		    // Hides the unordered list when clicking outside of it
		    $(document).click(function () {
		        $styledSelect.removeClass('active');
		        $list.hide();
		    });

		});




		$("input#select_image").change(function () {
		    $('#image_upload_form').submit(); 
		});




// Custom Select End

	// $('#category-tags ul li a').hover(function() {
	// 	$(this).child
	// }, function() {
	// 	/* Stuff to do when the mouse leaves the element */
	// });

});





