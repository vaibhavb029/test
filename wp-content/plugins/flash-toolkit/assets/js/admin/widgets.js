/* global flashToolkitLocalizeScript */
jQuery( function ( $ ) {

	var file_frame;

	// Uploading files
	$( document.body ).on( 'click', '.tg-image-upload', function( event ) {
		var $el = $( this );

		var file_target_input   = $el.parent().find( '.tg-media-input' );
		var file_target_preview = $el.parent().parent().find( '.tg-media-preview' );

		event.preventDefault();

		// Create the media frame.
		file_frame = wp.media.frames.media_file = wp.media({
			// Set the title of the modal.
			title: $el.data( 'choose' ),
			button: {
				text: $el.data( 'update' )
			},
			states: [
				new wp.media.controller.Library({
					title: $el.data( 'choose' ),
					library: wp.media.query({ type: 'image' })
				})
			]
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// Get the attachment from the modal frame.
			var attachment = file_frame.state().get( 'selection' ).first().toJSON();

			// Initialize input and preview change.
			file_target_input.val( attachment.url );
			file_target_preview.css({ display: 'none' }).find( 'img' ).remove();
			file_target_preview.css({ display: 'block' }).append( '<img src="' + attachment.url + '">' );
		});

		// Finally, open the modal.
		file_frame.open();
	});

	// Remove Media Preview
	$( document.body ).on( 'click', '.tg-media-remove', function(){
		var $el = $( this ).closest( '.media-uploader' );
		$el.find( '.tg-media-input' ).val( '' );
		$el.find( '.tg-media-preview' ).css({ display: 'none' }).find( 'img' ).remove();

		return false;
	});

	// Media Uploader Preview
	$( document.body ).on( 'flash-toolkit-init-media-preview', function() {
		$( 'input.tg-media-input' ).each( function() {
			var preview_image  = $( this ).val(),
				preview_target = $( this ).parent().siblings( '.tg-media-preview' );

			// Initialize image previews.
			if ( preview_image !== '' ) {
				preview_target.find( 'img.tg-media-preview-default' ).remove();
				preview_target.css({ display: 'block' }).append( '<img src="' + preview_image + '">' );
			}
		});
	}).trigger( 'flash-toolkit-init-media-preview' );

	$( document.body ).on( 'flash-toolkit-date-picker-init', function() {

		$( 'input.flash-datetime-picker').removeClass( 'hasDatepicker' );
		$( 'input.flash-datetime-picker' ).each( function() {
			$('input.flash-datetime-picker').datetimepicker({
				dateFormat: 'yy-mm-dd',
				timeFormat: 'HH:mm'
			});
		});
	}).trigger( 'flash-toolkit-date-picker-init' );


	$( document.body ).on( 'panelsopen', function() {
		$( document.body ).trigger( 'flash-toolkit-date-picker-init' );
	});

	// Availability options.
	$( document.body ).on( 'flash-toolkit-init-availability', function() {
		$( 'select.icon_chooser' ).change( function() {
			if ( $( this ).val() === 'image' ) {
				$( this ).closest( 'p' ).next( '.show_if_icon' ).hide();
				$( this ).closest( 'p' ).next().next( '.show_if_image' ).show();
			} else {
				$( this ).closest( 'p' ).next( '.show_if_icon' ).show();
				$( this ).closest( 'p' ).next().next( '.show_if_image' ).hide();
			}
		}).change();

		$( 'select.media_chooser' ).change( function() {
			if ( $( this ).val() === 'image' ) {
				$( this ).closest( '.widget-content' ).find( '.show_if_image' ).show();
				$( this ).closest( '.widget-content' ).find( '.show_if_video' ).closest( 'p' ).hide();
			} else {
				$( this ).closest( '.widget-content' ).find( '.show_if_image' ).hide();
				$( this ).closest( '.widget-content' ).find( '.show_if_video' ).closest( 'p' ).show();
			}
		}).change();

		$( 'select.filter_availability' ).change( function() {
			if ( $( this ).val() === '0' ) {
				$( this ).closest( '.widget-content' ).find( '.show_if_all_category' ).closest( 'p' ).show();
			} else {
				$( this ).closest( '.widget-content' ).find( '.show_if_all_category' ).closest( 'p' ).hide();
			}
		}).change();

		$( 'select.availability' ).change( function() {
			if ( $( this ).val() === 'latest' ) {
				$( this ).closest( 'p' ).next( 'p' ).hide();
			} else {
				$( this ).closest( 'p' ).next( 'p' ).show();
			}
		}).change();

		$( 'input.availability' ).change( function() {
			if ( $( this ).is( ':checked' ) ) {
				$( this ).closest( 'p' ).next( 'p' ).hide();
			} else {
				$( this ).closest( 'p' ).next( 'p' ).show();
			}
		}).change();

		$( 'select.videoplayer-style' ).change( function() {
			if ( $( this ).val() === 'player-background' ) {
				$( this ).closest( '.widget-content' ).find( '.videoplayer-icon-style' ).closest( 'p' ).hide();
				$( this ).closest( '.widget-content' ).find( '.videoplayer-btn-fields' ).closest( 'p' ).hide();
				$( this ).closest( '.widget-content' ).find( '.videoplayer-thumbnail' ).show();
			} else {
				$( this ).closest( '.widget-content' ).find( '.videoplayer-icon-style' ).closest( 'p' ).show();
				$( this ).closest( '.widget-content' ).find( '.videoplayer-btn-fields' ).closest( 'p' ).show();
				$( this ).closest( '.widget-content' ).find( '.videoplayer-thumbnail' ).hide();
			}
		}).change();

		$( 'select.hero-style-select' ).on( 'select2:select' , function(){
			if ( $( this ).val() === 'tg-hero--default' ) {

				$( this ).closest( '.widget-content' ).find( '.hero-title-font-select' ).val( 'Roboto' ).trigger( 'change' );
				$( this ).closest( '.widget-content' ).find( '.hero-subtitle-font-select' ).val( 'Roboto' ).trigger( 'change' );

			} else if ( $( this ).val() === 'tg-hero--thinner' ) {

				$( this ).closest( '.widget-content' ).find( '.hero-title-font-select' ).val( 'Raleway' ).trigger( 'change' );
				$( this ).closest( '.widget-content' ).find( '.hero-subtitle-font-select' ).val( 'Open Sans' ).trigger( 'change' );

			} else if ( $( this ).val() === 'tg-hero--border' ) {

				$( this ).closest( '.widget-content' ).find( '.hero-title-font-select' ).val( 'Archivo Black' ).trigger( 'change' );
				$( this ).closest( '.widget-content' ).find( '.hero-subtitle-font-select' ).val( 'Roboto' ).trigger( 'change' );

			} else if ( $( this ).val() === 'tg-hero--classic' ) {

				$( this ).closest( '.widget-content' ).find( '.hero-title-font-select' ).val( 'Playfair Display' ).trigger( 'change' );
				$( this ).closest( '.widget-content' ).find( '.hero-subtitle-font-select' ).val( 'PT Serif' ).trigger( 'change' );

			} else if ( $( this ).val() === 'tg-hero--cursive' ) {

				$( this ).closest( '.widget-content' ).find( '.hero-title-font-select' ).val( 'Lobster' ).trigger( 'change' );
				$( this ).closest( '.widget-content' ).find( '.hero-subtitle-font-select' ).val( 'Roboto' ).trigger( 'change' );

			}
		}).change();
	}).trigger( 'flash-toolkit-init-availability' );

	// Tabs
	$( document.body ).on('flash-toolkit-tabs', function() {

		$( document.body ).on('click', '.flash-tab-title-container .flash-tab-title', function(event) {
			event.preventDefault();
			$(this).addClass('active');
			$(this).siblings().removeClass('active');

			var tab = $(this).attr('href');
			$(this).parent().siblings('.flash-toolkit-tab-content-container').find('.flash-toolkit-tab').css('display', 'none');
			$(this).parent().siblings('.flash-toolkit-tab-content-container').find(tab).fadeIn();
		});

	}).trigger('flash-toolkit-tabs');

	// Accordion title.
	// @todo Not loading on customizer.
	$( document.body ).on( 'flash-toolkit-init-accordion-title', function() {
		$( '.tg-widget-repeater-field-items' ).children( 'li' ).each( function() {
			var title = $( 'input[id*="-title"]', this ).val() || '';

			if ( title ) {
				title = ': ' + title.replace(/<[^<>]+>/g, '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
			}

			$( this ).children( '.accordion-top' ).children( '.accordion-title' ).children().children( '.in-accordion-title' ).html( title );
		});
	}).trigger( 'flash-toolkit-init-accordion-title' );

	// Add list items.
	$( document.body ).on( 'click', '.tg-widget-repeater-field-add', function( e ) {
		e.preventDefault();

		// Prevent if max field entries.
		if ( $( this ).is( '.disabled' ) ) {
			window.alert( flashToolkitLocalizeScript.i18n_max_field_message );
			return;
		}

		var $widget     = $( this ).parents( '.widget-content' ),
			$size       = $widget.find( 'li.tg-widget-accordion-item' ).length + 1,
			$widget_id  = $widget.find( '.tg-widget-repeater-field-items' ).data( 'widget_id' ),
			$field_tmpl = wp.template( 'tg-widget-repeater-field-' + $widget_id );

		// Cast them all to integers, because strings compare funky. Sighhh.
		$widget.find( 'li.tg-widget-accordion-item' ).each( function( index, item ) {
			if ( $size === parseInt( $( item ).data( 'id' ).replace( /[^0-9\.]/g, '' ), 10 ) ) {
				$size++;
			}
		});

		$widget.find( '.tg-widget-repeater-field-button' ).show();
		$widget.find( '.tg-widget-repeater-field-blank-state' ).remove();
		$widget.find( '.tg-widget-repeater-field-items' ).append(
			$field_tmpl({
				field_id: $size
			})
		);

		// Check if max entries exceed.
		if ( $size >= flashToolkitLocalizeScript.i18n_max_field_entries ) {
			$widget.find( '.tg-widget-repeater-field-button a' ).addClass( 'disabled' );
		}

		// Trigger select2 on item add.
		$( document.body ).trigger( 'flash-enhanced-select-init' );
	});

	// Control accordion toggles.
	$( document.body ).on( 'click.accordion-toggle', function( e ) {
		var target = $( e.target ), field, inside, widget;

		if ( target.parents( '.accordion-top' ).length && ! target.parents( '#available-fields' ).length ) {
			field  = target.closest( 'li.tg-widget-accordion-item' );
			inside = field.children( '.accordion-inside' );

			if ( inside.is( ':hidden' ) ) {
				field.addClass( 'open' );
				inside.slideDown( 'fast' );
			} else {
				inside.slideUp( 'fast', function() {
					field.attr( 'style', '' );
					field.removeClass( 'open' );
				});
			}
			e.preventDefault();
		} else if ( target.hasClass( 'accordion-control-close' ) ) {
			field = target.closest( 'li.tg-widget-accordion-item' );

			field.children( '.accordion-inside' ).slideUp( 'fast', function() {
				field.attr( 'style', '' );
				field.removeClass( 'open' );
			});
			e.preventDefault();
		} else if ( target.hasClass( 'accordion-control-remove' ) ) {
			field = target.closest( 'li.tg-widget-accordion-item' );
			widget = target.parents( '.widget[id*=themegrill_flash], .widget-content' );
			field.remove();
			widgetUpdate( widget );
			e.preventDefault();
		}
	});

	// Make repeater field siteorigin compat.
	$( document.body ).on( 'panelsopen', function(e) {
		var target = $( e.target );

		// Check that this is for our widget class
		if( ! target.has( '.tg-widget-repeater-field-items' ) ) {
			return false;
		}

		target.addClass( 'widget-content' );

		widgetUpdate( target );
		widgetSortable( target );

		// Trigger enhanced select, availability & accordion title.
		$( document.body ).trigger( 'flash-enhanced-select-init' );
		$( document.body ).trigger( 'flash-toolkit-init-availability' );
		$( document.body ).trigger( 'flash-toolkit-init-media-preview' );
		$( document.body ).trigger( 'flash-toolkit-init-accordion-title' );
	});

	$( document.body ).on( 'click', '.so-close', function() {
		$( document.body ).trigger( 'flash-toolkit-init-accordion-title' );
	});

	// Event handler for widget open button.
	$( document.body ).on( 'click', 'div.widget[id*=themegrill_flash] .widget-title, div.widget[id*=themegrill_flash] .widget-title-action', function() {
		if ( $( this ).parents( '#available-widgets' ).length ) {
			return;
		}

		widgetUpdate( $( this ).parents( '.widget[id*=themegrill_flash]' ) );
		widgetSortable( $( this ).parents( '.widget[id*=themegrill_flash]' ) );
	});

	// Event handler for widget added and updated.
	$( document ).on( 'widget-added widget-updated', function( e, widget ) {
		if ( widget.is( '[id*=themegrill_flash]' ) ) {
			e.preventDefault();
			widgetUpdate( widget );
			widgetSortable( widget );

			// Trigger enhanced select, availability & accordion title.
			$( document.body ).trigger( 'flash-enhanced-select-init' );
			$( document.body ).trigger( 'flash-toolkit-init-availability' );
			$( document.body ).trigger( 'flash-toolkit-init-media-preview' );
			$( document.body ).trigger( 'flash-toolkit-init-accordion-title' );
			$( document.body ).trigger( 'flash-toolkit-date-picker-init' );
		}
	});

	function widgetUpdate( widget ) {
		var $field_items    = widget.find( '.tg-widget-repeater-field-items' ),
			$field_counter  = $field_items.find( 'li.tg-widget-accordion-item' ),
			$blank_template = wp.template( 'tg-widget-repeater-field-blank' );

		if ( $field_counter.length ) {
			widget.find( '.tg-widget-repeater-field-button' ).show();

			if ( $field_counter.length < flashToolkitLocalizeScript.i18n_max_field_entries ) {
				widget.find( '.tg-widget-repeater-field-button a' ).removeClass( 'disabled' );
			}
		} else {
			widget.find( '.tg-widget-repeater-field-button' ).hide();
			widget.find( '.tg-widget-repeater-field-blank-state' ).remove();

			// Append blank template.
			$field_items.append( $blank_template );
		}
	}

	function widgetSortable( widget ) {
		widget.find( '.tg-widget-repeater-field-items' ).sortable({
			items: '> li',
			handle: '> .accordion-top > .accordion-title',
			cursor: 'move',
			axis: 'y',
			distance: 2,
			opacity: 0.65,
			scrollSensitivity: 40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			placeholder: 'tg-widget-sortable-placeholder',
			start: function( event, ui ) {
				var inside = ui.item.children( '.accordion-inside' );

				if ( inside.css( 'display' ) === 'block' ) {
					ui.item.removeClass( 'open' );
					inside.hide();
					$( this ).sortable( 'refreshPositions' );
				}
			},
			stop: function( event, ui ) {
				ui.item.removeAttr( 'style' );
			}
		});
	}
});
