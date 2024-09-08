jQuery(document).ready(function ($) {
	$(".wcq-color-picker").wpColorPicker();

	$("#wcq-settings-form").on("submit", function (e) {
		e.preventDefault();
		showPreloader();
		var data = {
			action: "save_wcq_settings",
			wcq_save_settings_nonce: $('input[name="wcq_save_settings_nonce"]').val(),
			button_quote: {
				padding: {
					top: $("#button_quote_padding_top").val(),
					right: $("#button_quote_padding_right").val(),
					bottom: $("#button_quote_padding_bottom").val(),
					left: $("#button_quote_padding_left").val(),
				},
				background_color: $("#button_quote_background_color").val(),
				text_color: $("#button_quote_text_color").val(),
				hover_background: $("#button_quote_hover_background").val(),
				hover_text_color: $("#button_quote_hover_text_color").val(),
				position: $("#button_quote_position").val(),
				position_one_per: $("#button_quote_position_one_per").val(),
				position_two_per: $("#button_quote_position_two_per").val(),
				text: $("#button_quote_text").val(),
			},
			button_empty_cart: {
				padding: {
					top: $("#button_empty_cart_padding_top").val(),
					right: $("#button_empty_cart_padding_right").val(),
					bottom: $("#button_empty_cart_padding_bottom").val(),
					left: $("#button_empty_cart_padding_left").val(),
				},
				background_color: $("#button_empty_cart_background_color").val(),
				text_color: $("#button_empty_cart_text_color").val(),
				hover_background: $("#button_empty_cart_hover_background").val(),
				hover_text_color: $("#button_empty_cart_hover_text_color").val(),
				position: $("#button_empty_cart_position").val(),
				position_one_per: $("#button_empty_cart_position_one_per").val(),
				position_two_per: $("#button_empty_cart_position_two_per").val(),
				text: $("#button_empty_cart_text").val(),
			},
			notices: {
				border_radius: $("#notices_border_radius").val(),
				success: {
					text: $("#notices_success_text").val(),
					background_color: $("#notices_success_background").val(),
					text_color: $("#notices_success_text_color").val(),
				},
				error: {
					text: $("#notices_error_text").val(),
					background_color: $("#notices_success_background").val(),
					text_color: $("#notices_success_text_color").val(),
				},
			},
			messages: {
				success: {
					cart_quote: $("#messages_success_cart_quote").val(),
					cart_empty: $("#messages_success_cart_empty").val(),
				},
				error: {
					cart_quote: $("#messages_error_cart_quote").val(),
					cart_empty: $("#messages_error_cart_empty").val(),
				},
			},
		};

		$.post(wcqForm.ajax_url, data, function (response) {
			var notice = $("#wcq-settings-notice");
			if (response.success) {
				notice
					.removeClass("notice-error")
					.addClass("notice-success")
					.text(response.data);
			} else {
				notice
					.removeClass("notice-success")
					.addClass("notice-error")
					.text(response.data);
			}
			notice.show();
			hidePreloader();
		});
	});
});
