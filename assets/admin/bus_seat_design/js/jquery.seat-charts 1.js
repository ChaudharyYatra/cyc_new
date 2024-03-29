/*!
 * jQuery-Seat-Charts v1.1.1
 * https://github.com/mateuszmarkowski/jQuery-Seat-Charts
 *
 * Copyright 2013, 2014 Mateusz Markowski
 * Released under the MIT license
 */
if(js_array.length != 0){
    var vehicle_seat_data = js_array;

	var admin_hold_string = js_array.admin_hold_seats;
    var admin_hold_seat_array = admin_hold_string.split(',');
}

(function($) {
		
	//'use strict';	
		var pqr=[];
		var ttttt=0;
		
	$.fn.seatCharts = function (setup) {
		//if there's seatCharts object associated with the current element, return it
		if (this.data('seatCharts')) {
			return this.data('seatCharts');
		}
		var did='1';
		var $cart = $('#selected-seats');
		$counter = $('#counter');
            $total = $('#total');
		var fn       = this,
			seats    = {},
			seatIds  = [],
			legend,
			settings = {
				animate : false, //requires jQuery UI
				naming  : {
					top    : true,
					left   : true,
					getId  : function(character, row, column) {
						if(character=='z')
						{
							return 'id_disz';
						}else if(character=='x')
						{
							return 'id_disx';
						}else{
						return row + '_' + column;
						}
					},
					getLabel : function (character, row, column) {
						column=a['A'];
						return column;
					}
					
				},
				legend : {
					node   : null,
					items  : []
				},
				click   : function() {

					if (this.status() == 'available') {
						return 'selected';
					} else if (this.status() == 'selected') {
						return 'available';
					} else {
						return this.style();
					}
					
				},
				focus  : function() {
					// console.log(this.status());
					if (this.status() == 'available') {
						return 'focused';
					} else if (this.status() == 'unavailable') {
						return 'unavailable';
					} {
						return this.style();
						
					}
				},
				// blur   : function() {
				// 	return this.status();
				// },
				blur   : function() {
					// alert(this.status());
					if (this.status() == 'unavailable') {
						return 'unavailable';	
					} else{
						return this.status();	
					}
				},
				seats   : {}
			
			},
			//seat will be basically a seat object which we'll when generating the map
			seat = (function(seatCharts, seatChartsSettings) {

				return function (setup) {
					var fn = this;
			
					
					fn.settings = $.extend({
						status : 'available', //available, unavailable, selected
						style  : 'available',
						//make sure there's an empty hash if user doesn't pass anything
						data   : seatChartsSettings.seats[setup.character] || {}
						//anything goes here?
					}, setup);
				
					var objectLength = Object.keys(fn).length;
					// console.log('objectLength',did);

					// current_prev_cls


					fn.settings.$node = $('<div></div>');
					var title='';

					fn.settings.$node
						.attr({
							id             : fn.settings.id,
							role           : 'checkbox',
							'aria-checked' : false,
							focusable      : true,
							tabIndex       : -1, //manual focus
							data_id		   : did,
							title          : title,
							seat_type      :fn.settings.data.classes,
							seat_price     :fn.settings.data.price,
						})
						.text(fn.settings.label)
						.addClass(['seatCharts-seat', 'seatCharts-cell', 'available'].concat(
							//let's merge custom user defined classes with standard JSC ones
							fn.settings.classes, 
							typeof seatChartsSettings.seats[fn.settings.character] == "undefined" ? 
								[] : seatChartsSettings.seats[fn.settings.character].classes
							).join(' '));



					var setting_label=fn.settings.label
					var setting_label_string=setting_label.toString();
					if($.inArray(fn.settings.id, booked_seats_data) != '-1' && $.inArray(setting_label_string, admin_hold_seat_array) == '-1')
					{
						// fn.settings.status(fn.settings.id,'unvailable');
						// fn.settings.status('2_15','unvailable');
						fn.settings = $.extend({
							status : '', //available, unavailable, selected
							style  : '',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

						fn.settings = $.extend({
							status : 'unvailable', //available, unavailable, selected
							style  : 'unvailable',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);
						fn.settings.$node = $('<div></div>');
						var title='';

						fn.settings.$node
						.attr({
							id             : fn.settings.id,
							role           : 'checkbox',
							'aria-checked' : false,
							focusable      : true,
							tabIndex       : -1, //manual focus
							data_id		   : did,
							title          : title,
							seat_type      :fn.settings.data.classes,
							seat_price     :fn.settings.data.price,
						})
						.text(fn.settings.label)
						.addClass(['seatCharts-seat', 'seatCharts-cell', 'available'].concat(
							//let's merge custom user defined classes with standard JSC ones
							fn.settings.classes, 
							typeof seatChartsSettings.seats[fn.settings.character] == "undefined" ? 
								[] : seatChartsSettings.seats[fn.settings.character].classes
							).join(' '));
					}
					else if($.inArray(fn.settings.id, temp_booked_seats_data) != '-1'  && $.inArray(fn.settings.id, temp_hold_seats_data) == '-1'
										&& $.inArray(setting_label_string, admin_hold_seat_array) == '-1')
					{

						fn.settings = $.extend({
							status : '', //available, unavailable, selected
							style  : '',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

						fn.settings = $.extend({
							status : 'selected', //available, unavailable, selected
							style  : 'selected',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

				
						// var previousSeatClass = seat.prev().attr('class');
						// console.log('vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv',previousSeatClass);
						var seat = $(this);
						// var seatId = fn.settings.data;
						var seatId = seat.prev('.seat');

						
						var for_windows_cls=fn.settings.data.classes;
						var check_str='window';
						var check_str_window_economy='window-economy-class';
                        var check_str_economy='economy-class';
                        var check_str_window_fourth='window-fourth-class';
                        var check_str_fourth='fourth-class';

						var selected_seat_id=fn.settings.label;

						// if(for_windows_cls!='window-economy-class' && for_windows_cls!='window-fourth-class'){

							if(for_windows_cls.indexOf(check_str)!=-1){

						
								// var clicked_prev=selected_seat_id-1;
								// var prev_id_str=clicked_prev.toString();
								// var clicked_next=parseInt(selected_seat_id)+1;
								// var next_id_str=clicked_next.toString();

								
							if(fn.settings.label==1){
									
									var row = fn.settings.id.split('_')[0];
									var column = parseInt(fn.settings.id.split('_')[1]);
									
									var nextColumn = column + 1;
									var nextColumnStr = nextColumn.toString();
									var nextSeatId = row + '_' + nextColumnStr;

									var concatenatedString = seatChartsSettings.map.join(',');
									var stringWithoutUnderscores = concatenatedString.replace(/_/g, '');
									var arrayFromText = stringWithoutUnderscores.split(',');

									var individualCharacters = [];

									arrayFromText.forEach(function (str) {
										var characters = str.split('');
										individualCharacters = individualCharacters.concat(characters);
									});

									
									var current_id=fn.settings.id;
									var next_id = column + parseInt(1);
									var next_id_str=next_id.toString();

									if($.inArray(next_id_str, temp_booking_data_id) != '-1'){
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(fn.settings.data.price);
									}
									else if($.inArray(next_id_str, temp_booking_data_id) == '-1'){
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);

									}	
							}else if(fn.settings.label!=1)
							{
										var row = fn.settings.id.split('_')[0];
										var column = parseInt(fn.settings.id.split('_')[1]);
										
										var nextColumn = column + 1;
										var nextColumnStr = nextColumn.toString();
										var nextSeatId = row + '_' + nextColumnStr;
	
										var concatenatedString = seatChartsSettings.map.join(',');
										var stringWithoutUnderscores = concatenatedString.replace(/_/g, '');
										var arrayFromText = stringWithoutUnderscores.split(',');
										var individualCharacters = [];
	
										arrayFromText.forEach(function (str) {
											var characters = str.split('');
											individualCharacters = individualCharacters.concat(characters);
										});
	
	
										var current_id=fn.settings.id;
										var prev_id = fn.settings.label - parseInt(1);
										var prev_id_str=prev_id.toString();
										var prev_prev_id= prev_id - parseInt(1);
										var prev_prev_id_str=prev_prev_id.toString();


										var next_id = fn.settings.label + parseInt(1);
										var next_id_str=next_id.toString();

										console.log(individualCharacters);
										
									

									
								if(for_windows_cls.indexOf(check_str_window_economy)==-1 && for_windows_cls.indexOf(check_str_window_fourth)==-1)
								{	

									if(individualCharacters[prev_prev_id_str] == 'a')
									{
										prev_cls = "seatCharts-seat seatCharts-cell window-first-class";
									}else if(individualCharacters[prev_prev_id_str] == 'f')
									{
										prev_cls = "seatCharts-seat seatCharts-cell first-class";
									}else if(individualCharacters[prev_prev_id_str] == 'b')
									{
										prev_cls = "seatCharts-seat seatCharts-cell window-second-class";
									}else if(individualCharacters[prev_prev_id_str] == 's')
									{
										prev_cls = "seatCharts-seat seatCharts-cell second-class";
									}


									if(individualCharacters[fn.settings.label] == 'a')
									{
										next_cls = "seatCharts-seat seatCharts-cell window-first-class";
									}else if(individualCharacters[fn.settings.label] == 'f')
									{
										next_cls = "seatCharts-seat seatCharts-cell first-class";
									}else if(individualCharacters[fn.settings.label] == 'b')
									{
										next_cls = "seatCharts-seat seatCharts-cell window-second-class";
									}else if(individualCharacters[fn.settings.label] == 's')
									{
										next_cls = "seatCharts-seat seatCharts-cell second-class";
									}else if(individualCharacters[fn.settings.label] == 'c')
									{
										next_cls = "seatCharts-seat seatCharts-cell window-economy-class";
									}


									if(prev_cls.indexOf(check_str)==-1 && next_cls.indexOf(check_str)!=-1
											&& $.inArray(prev_id_str, temp_booking_data_id) == -1)
									{
										console.log('window1');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										// console.log(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);
									}else if(prev_cls.indexOf(check_str)==-1 && next_cls.indexOf(check_str)!=-1
									&& $.inArray(prev_id_str, temp_booking_data_id) != -1)
									{
										console.log('window2');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										// console.log(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.price);
									}
									else if(prev_cls.indexOf(check_str)!=-1 && next_cls.indexOf(check_str)==-1
											&& $.inArray(next_id_str, temp_booking_data_id) == -1)
									{
										console.log('window3');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										// console.log(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);
									}
									else if(prev_cls.indexOf(check_str)!=-1 && next_cls.indexOf(check_str)==-1
											&& $.inArray(next_id_str, temp_booking_data_id) != -1)
									{
										console.log('window4');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										// console.log(fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.price);
									}

								}

								// इथून पुढे इकॉनॉमी विंडो सीट चालू होतात 

								else if(for_windows_cls.indexOf(check_str_window_economy)!=-1 && for_windows_cls.indexOf(check_str_window_fourth)==-1)
								{

									if(individualCharacters[prev_prev_id_str] == 'c')
									{
										prev_cls = "seatCharts-seat seatCharts-cell window-economy-class";
									}else if(individualCharacters[prev_prev_id_str] == 'e')
									{
										prev_cls = "seatCharts-seat seatCharts-cell economy-class";
									}else if(individualCharacters[prev_prev_id_str] == 'b')
									{
										prev_cls = "seatCharts-seat seatCharts-cell window-second-class";
									}


									if(individualCharacters[fn.settings.label] == 'c')
									{
										next_cls = "seatCharts-seat seatCharts-cell window-economy-class";
									}else if(individualCharacters[fn.settings.label] == 'e')
									{
										next_cls = "seatCharts-seat seatCharts-cell economy-class";
									}else if(individualCharacters[fn.settings.label] == 'd')
									{
										next_cls = "seatCharts-seat seatCharts-cell window-fourth-class";
									}

									if(prev_cls.indexOf(check_str)!=-1 && next_cls.indexOf(check_str)==-1
											&& $.inArray(next_id_str, temp_booking_data_id) == -1)
									{
										console.log('economy window 1');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);
									}else if(prev_cls.indexOf(check_str)!=-1 && next_cls.indexOf(check_str)==-1
									&& $.inArray(next_id_str, temp_booking_data_id) != -1)
									{
										console.log('economy window 2');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
									}else if(prev_cls.indexOf(check_str)==-1 && next_cls.indexOf(check_str)!=-1
									&& $.inArray(prev_id_str, temp_booking_data_id) == -1)
									{
										console.log('economy window 3');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);
									}else if(prev_cls.indexOf(check_str)==-1 && next_cls.indexOf(check_str)!=-1
									&& $.inArray(prev_id_str, temp_booking_data_id) != -1)
									{
										console.log('economy window 4');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
									}
								}		

								// इथून पुढे फोरथ विंडो सीट चालू होतात 
								else if(for_windows_cls.indexOf(check_str_window_economy)==-1 && for_windows_cls.indexOf(check_str_window_fourth)!=-1)
								{

									var total_seats=individualCharacters.length;
									if(individualCharacters[prev_prev_id_str] == 'd')
									{
										prev_cls = "seatCharts-seat seatCharts-cell window-fourth-class";
									}else if(individualCharacters[prev_prev_id_str] == 'v')
									{
										prev_cls = "seatCharts-seat seatCharts-cell fourth-class";
									}else if(individualCharacters[prev_prev_id_str] == 'c')
									{
										prev_cls = "seatCharts-seat seatCharts-cell window-economy-class";
									}


									if(individualCharacters[fn.settings.label] == 'd')
									{
										next_cls = "seatCharts-seat seatCharts-cell window-fourth-class";
									}else if(individualCharacters[fn.settings.label] == 'v')
									{
										next_cls = "seatCharts-seat seatCharts-cell fourth-class";
									}

									if(prev_cls.indexOf(check_str)!=-1 && next_cls.indexOf(check_str)==-1
											&& $.inArray(next_id_str, temp_booking_data_id) == -1)
									{
										console.log('fourth window 1');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);
									}else if(prev_cls.indexOf(check_str)!=-1 && next_cls.indexOf(check_str)==-1
									&& $.inArray(next_id_str, temp_booking_data_id) != -1)
									{
										console.log('fourth window 2');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
									}else if(prev_cls.indexOf(check_str)==-1 && total_seats == fn.settings.label
									&& $.inArray(prev_id_str, temp_booking_data_id) == -1)
									{
										console.log('fourth window 3'); 
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li><li class="cart-item-cls-'+ fn.settings.id +'" attr_win_remove="win_'+ fn.settings.id +'">'
										+ fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. '+ fn.settings.data.attr_win + '</b></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
										ttttt += parseInt(fn.settings.data.attr_win);
									}else if(prev_cls.indexOf(check_str)==-1 && total_seats == fn.settings.label
									&& $.inArray(prev_id_str, temp_booking_data_id) != -1)
									{
										console.log('fourth window 4');
										$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
										.attr('id', 'cart-item-' + fn.settings.id)
										.data('seatId', fn.settings.id)
										.appendTo($cart);
										pqr.push(fn.settings.data.price)
										$counter.text(temp_booked_seats_data.length);
										ttttt += parseInt(-fn.settings.data.price);
									}
								}




									
								}
								
							}else{

								if(for_windows_cls.indexOf(check_str_economy)==-1 && for_windows_cls.indexOf(check_str_fourth)==-1)
								{
									console.log('else nonwindow 1')
									$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs.' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
									.attr('id', 'cart-item-' + fn.settings.id)
									.data('seatId', fn.settings.id)
									.appendTo($cart);
									pqr.push(fn.settings.data.price)
									$counter.text(temp_booked_seats_data.length);
									ttttt += parseInt(fn.settings.data.price);
								}else if(for_windows_cls.indexOf(check_str_economy)!=-1 && for_windows_cls.indexOf(check_str_fourth)==-1)
								{
									console.log('else nonwindow 2')
									$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
									.attr('id', 'cart-item-' + fn.settings.id)
									.data('seatId', fn.settings.id)
									.appendTo($cart);
									pqr.push(fn.settings.data.price)
									$counter.text(temp_booked_seats_data.length);
									ttttt += parseInt(-fn.settings.data.price);
								}if(for_windows_cls.indexOf(check_str_economy)==-1 && for_windows_cls.indexOf(check_str_fourth)!=-1)
								{
									console.log('else nonwindow 3')
									$('<li class="cart-item-cls-'+ fn.settings.id +'">' + fn.settings.data.classes + ' Seat # ' + fn.settings.label + ': <b>Rs. -' + fn.settings.data.price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
									.attr('id', 'cart-item-' + fn.settings.id)
									.data('seatId', fn.settings.id)
									.appendTo($cart);
									pqr.push(fn.settings.data.price)
									$counter.text(temp_booked_seats_data.length);
									ttttt += parseInt(-fn.settings.data.price);
								}
							}
						
						
						$total.text(ttttt);
						fn.settings.$node = $('<div></div>');
						var title='';

						fn.settings.$node
						.attr({
							id             : fn.settings.id,
							role           : 'checkbox',
							'aria-checked' : false,
							focusable      : true,
							tabIndex       : -1, //manual focus
							data_id		   : did,
							title          : title,
							seat_type      :fn.settings.data.classes,
							seat_price     :fn.settings.data.price,
						})
						.text(fn.settings.label)
						.addClass(['seatCharts-seat', 'seatCharts-cell', 'available'].concat(
							//let's merge custom user defined classes with standard JSC ones
							fn.settings.classes, 
							typeof seatChartsSettings.seats[fn.settings.character] == "undefined" ? 
								[] : seatChartsSettings.seats[fn.settings.character].classes
							).join(' '));
				}
				else if($.inArray(fn.settings.id, temp_hold_seats_data) != '-1' && $.inArray(setting_label_string, admin_hold_seat_array) == '-1')
				{
					console.log('llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll');

						fn.settings = $.extend({
							status : '', //available, unavailable, selected
							style  : '',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

						fn.settings = $.extend({
							status : 'hold', //available, unavailable, selected
							style  : 'hold',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

						fn.settings.$node = $('<div></div>');
						var title='This seat is on hold for some time';

						fn.settings.$node
						.attr({
							id             : fn.settings.id,
							role           : 'checkbox',
							'aria-checked' : false,
							focusable      : true,
							tabIndex       : -1, //manual focus
							data_id		   : did,
							title          : title,
							seat_type      :fn.settings.data.classes,
							seat_price     :fn.settings.data.price,
						})
						.text(fn.settings.label)
						.addClass(['seatCharts-seat', 'seatCharts-cell', 'available'].concat(
							//let's merge custom user defined classes with standard JSC ones
							fn.settings.classes, 
							typeof seatChartsSettings.seats[fn.settings.character] == "undefined" ? 
								[] : seatChartsSettings.seats[fn.settings.character].classes
							).join(' '));

				}
					else if($.inArray(setting_label_string, admin_hold_seat_array) != '-1' && $.inArray(fn.settings.id, booked_seats_data) == '-1'
					        && $.inArray(fn.settings.id, temp_booked_seats_data) == '-1' && $.inArray(fn.settings.id, temp_hold_seats_data) == '-1')
					{
						// console.log('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy',fn.settings.id);

						fn.settings = $.extend({
							status : '', //available, unavailable, selected
							style  : '',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

						fn.settings = $.extend({
							status : 'unavailable', //available, unavailable, selected
							style  : 'unavailable',
							//make sure there's an empty hash if user doesn't pass anything
							data   : seatChartsSettings.seats[setup.character] || {}
							//anything goes here?
						}, setup);

						fn.settings.$node = $('<div></div>');
						var title='This seat is on hold for some time';

						fn.settings.$node
						.attr({
							id             : fn.settings.id,
							role           : 'checkbox',
							'aria-checked' : false,
							focusable      : true,
							tabIndex       : -1, //manual focus
							data_id		   : did,
							title          : title,
							seat_type      :fn.settings.data.classes,
							seat_price     :fn.settings.data.price,
						})
						.text(fn.settings.label)
						.addClass(['seatCharts-seat', 'seatCharts-cell', 'admin_hold'].concat(
							//let's merge custom user defined classes with standard JSC ones
							fn.settings.classes, 
							typeof seatChartsSettings.seats[fn.settings.character] == "undefined" ? 
								[] : seatChartsSettings.seats[fn.settings.character].classes
							).join(' '));
					}
					
					


					console.log('fn.settings.datafn.settings.datafn.settings.datafn.settings.data',fn.settings.data);
					//basically a wrapper function
					fn.data = function() {
						return fn.settings.data;
					};
					
					fn.char = function() {
						return fn.settings.character;
					};
					
					fn.node = function() {
						return fn.settings.$node;						
					};

					/*
					 * Can either set or return status depending on arguments.
					 *
					 * If there's no argument, it will return the current style.
					 *
					 * If you pass an argument, it will update seat's style
					 */
					fn.style = function() {

						return arguments.length == 1 ?
							(function(newStyle) {
								var oldStyle = fn.settings.style;

								//if nothing changes, do nothing
								if (newStyle == oldStyle) {
									return oldStyle;
								}
								
								//focused is a special style which is not associated with status
								fn.settings.status = newStyle != 'focused' ? newStyle : fn.settings.status;
								fn.settings.$node
									.attr('aria-checked', newStyle == 'selected');

								//if user wants to animate status changes, let him do this
								seatChartsSettings.animate ?
									fn.settings.$node.switchClass(oldStyle, newStyle, 200) :
									fn.settings.$node.removeClass(oldStyle).addClass(newStyle);
									
								return fn.settings.style = newStyle;
							})(arguments[0]) : fn.settings.style;
					};
					
					//either set or retrieve
					fn.status = function() {
	
						return fn.settings.status = arguments.length == 1 ? 
							fn.style(arguments[0]) : fn.settings.status;
					};
					console.log('fn.statusfn.statusfn.statusfn.status',fn.status());
					//using immediate function to convienietly get shortcut variables
					(function(seatSettings, character, seat) {
						//attach event handlers
						$.each(['click', 'focus', 'blur'], function(index, callback) {
						
							//we want to be able to call the functions for each seat object
							fn[callback] = function() {
								if (callback == 'focus') {
									//if there's already a focused element, we have to remove focus from it first
									if (seatCharts.attr('aria-activedescendant') !== undefined) {
										seats[seatCharts.attr('aria-activedescendant')].blur();
									}
									seatCharts.attr('aria-activedescendant', seat.settings.id);
									seat.node().focus();
								}
							
								/*
								 * User can pass his own callback function, so we have to first check if it exists
								 * and if not, use our default callback.
								 *
								 * Each callback function is executed in the current seat context.
								 */
								return fn.style(typeof seatSettings[character][callback] === 'function' ?
									seatSettings[character][callback].apply(seat) : seatChartsSettings[callback].apply(seat));
							};
							
						});
					//the below will become seatSettings, character, seat thanks to the immediate function		
					})(seatChartsSettings.seats, fn.settings.character, fn);
							
					fn.node()
						//the first three mouse events are simple
						.on('click',      fn.click)
						.on('mouseenter', fn.focus)
						.on('mouseleave', fn.blur)
						
						//keydown requires quite a lot of logic, because we have to know where to move the focus
						.on('keydown',    (function(seat, $seat) {
						
							return function (e) {
								
								var $newSeat;
								
								//everything depends on the pressed key
								switch (e.which) {
									//spacebar will just trigger the same event mouse click does
									case 32:
										e.preventDefault();
										seat.click();
										break;
									//UP & DOWN
									case 40:
									case 38:
										e.preventDefault();
										
										/*
										 * This is a recursive, immediate function which searches for the first "focusable" row.
										 * 
										 * We're using immediate function because we want a convenient access to some DOM elements
										 * We're using recursion because sometimes we may hit an empty space rather than a seat.
										 *
										 */
										$newSeat = (function findAvailable($rows, $seats, $currentRow) {
											var $newRow;
											
											//let's determine which row should we move to
											
											if (!$rows.index($currentRow) && e.which == 38) {
												//if this is the first row and user has pressed up arrow, move to the last row
												$newRow = $rows.last();
											} else if ($rows.index($currentRow) == $rows.length-1 && e.which == 40) {
												//if this is the last row and user has pressed down arrow, move to the first row
												$newRow = $rows.first();
											} else {
												//using eq to get an element at the desired index position
												$newRow = $rows.eq(
													//if up arrow, then decrement the index, if down increment it
													$rows.index($currentRow) + (e.which == 38 ? (-1) : (+1))
												);
											}												
											
											//now that we know the row, let's get the seat using the current column position
											$newSeat = $newRow.find('.seatCharts-seat,.seatCharts-space').eq($seats.index($seat));
											
											//if the seat we found is a space, keep looking further
											return $newSeat.hasClass('seatCharts-space') ?
												findAvailable($rows, $seats, $newRow) : $newSeat;
											
										})($seat
											//get a reference to the parent container and then select all rows but the header
												.parents('.seatCharts-container')
												.find('.seatCharts-row:not(.seatCharts-header)'),
											$seat
											//get a reference to the parent row and then find all seat cells (both seats & spaces)
												.parents('.seatCharts-row:first')
												.find('.seatCharts-seat,.seatCharts-space'),
											//get a reference to the current row
											$seat.parents('.seatCharts-row:not(.seatCharts-header)')
										);
										
										//we couldn't determine the new seat, so we better give up
										if (!$newSeat.length) {
											return;
										}
										
										//remove focus from the old seat and put it on the new one
										seat.blur();
										seats[$newSeat.attr('id')].focus();
										$newSeat.focus();
										
										//update our "aria" reference with the new seat id
										seatCharts.attr('aria-activedescendant', $newSeat.attr('id'));
																			
										break;										
									//LEFT & RIGHT
									case 37:
									case 39:
										e.preventDefault();
										/*
										 * The logic here is slightly different from the one for up/down arrows.
										 * User will be able to browse the whole map using just left/right arrow, because
										 * it will move to the next row when we reach the right/left-most seat.
										 */
										$newSeat = (function($seats) {
										
											if (!$seats.index($seat) && e.which == 37) {
												//user has pressed left arrow and we're currently on the left-most seat
												return $seats.last();
											} else if ($seats.index($seat) == $seats.length -1 && e.which == 39) {
												//user has pressed right arrow and we're currently on the right-most seat
												return $seats.first();
											} else {
												//simply move one seat left or right depending on the key
												return $seats.eq($seats.index($seat) + (e.which == 37 ? (-1) : (+1)));
											}

										})($seat
											.parents('.seatCharts-container:first')
											.find('.seatCharts-seat:not(.seatCharts-space)'));
										
										if (!$newSeat.length) {
											return;
										}
											
										//handle focus
										seat.blur();	
										seats[$newSeat.attr('id')].focus();
										$newSeat.focus();
										
										//update our "aria" reference with the new seat id
										seatCharts.attr('aria-activedescendant', $newSeat.attr('id'));
										break;	
									default:
										break;
								
								}
							};
								
						})(fn, fn.node()));
						//.appendTo(seatCharts.find('.' + row));
						did++;
				}
				
			})(fn, settings);
			
		fn.addClass('seatCharts-container');
		
		//true -> deep copy!
		$.extend(true, settings, setup);		
		
		//Generate default row ids unless user passed his own
		settings.naming.rows = settings.naming.rows || (function(length) {
			var rows = [];
			for (var i = 0; i < length; i++) {
		var row_abc=settings.map[i].split('');

				if(row_abc=='x' || row_abc=='z')
				{
				rows.push(0);
				}else{
					var oo=i+1;
				rows.push(oo);
				}
			}
			return rows;
		})(settings.map.length);
		
		//Generate default column ids unless user passed his own

		settings.naming.columns = settings.naming.columns || (function(length) {
			var columns = [];
			for (var i = 1; i <= length; i++) {
				columns.push(i);
			}
			return columns;
		})(settings.map[0].split('').length);
		
		if (settings.naming.top) {
			var $headerRow = $('<div></div>')
				.addClass('seatCharts-row seatCharts-header');
			
			if (settings.naming.left) {
				$headerRow.append($('<div></div>').addClass('seatCharts-cell'));
			}
			
				
			$.each(settings.naming.columns, function(index, value) {
				$headerRow.append(
					$('<div></div>')
						.addClass('seatCharts-cell')
						.text(value)
				);
			});
		}
		
		fn.append($headerRow);
		
		//do this for each map row
		$.each(settings.map, function(row, characters) {

			var $row = $('<div></div>').addClass('seatCharts-row');
				
			if (settings.naming.left) {
				$row.append(
					$('<div></div>')
						.addClass('seatCharts-cell seatCharts-space')
						.text(settings.naming.rows[row])
				);
			}

			/*
			 * Do this for each seat (letter)
			 *
			 * Now users will be able to pass custom ID and label which overwrite the one that seat would be assigned by getId and
			 * getLabel
			 *
			 * New format is like this:
			 * a[ID,label]a[ID]aaaaa
			 *
			 * So you can overwrite the ID or label (or both) even for just one seat.
			 * Basically ID should be first, so if you want to overwrite just label write it as follows:
			 * a[,LABEL]
			 *
			 * Allowed characters in IDs areL 0-9, a-z, A-Z, _
			 * Allowed characters in labels are: 0-9, a-z, A-Z, _, ' ' (space)
			 *
			 */
			 
			$.each(characters.match(/[a-z_]{1}(\[[0-9a-z_]{0,}(,[0-9a-z_ ]+)?\])?/gi), function (column, characterParams) { 
				

				var matches         = characterParams.match(/([a-z_]{1})(\[([0-9a-z_ ,]+)\])?/i),
					//no matter if user specifies [] params, the character should be in the second element
					character       = matches[1],
					//check if user has passed some additional params to override id or label
					params          = typeof matches[3] !== 'undefined' ? matches[3].split(',') : [],
					//id param should be first
					overrideId      = params.length ? params[0] : null,
					//label param should be second
					overrideLabel   = params.length === 2 ? params[1] : null;
				$row.append(character != '_' ?
					//if the character is not an underscore (empty space)
					(function(naming) {
						// character='x';
						//so users don't have to specify empty objects
						settings.seats[character] = character in settings.seats ? settings.seats[character] : {};
	
						var id = overrideId ? overrideId : naming.getId(character, naming.rows[row], naming.columns[column]);

						if(character=='x'){
							seats[id] = new seat({
								id        : id,
								label     : 'A',
								row       : row,
								column    : column,
								character : character
							});
						}else if(character=='z')
						{
							seats[id] = new seat({
								id        : id,
								label     : 'B',
								row       : row,
								column    : column,
								character : character
							});
						}else{
						seats[id] = new seat({
							id        : id,
							label     : overrideLabel ?
								overrideLabel : naming.getLabel(character, naming.rows[row], naming.columns[column]),
							row       : row,
							column    : column,
							character : character
						});
					}
						seatIds.push(id);
						return seats[id].node();
						
					})(settings.naming) :
					//this is just an empty space (_)
					$('<div></div>').addClass('seatCharts-cell seatCharts-space')	
				);
			});
			
			fn.append($row);
		});
	
		//if there're any legend items to be rendered
		settings.legend.items.length ? (function(legend) {
			//either use user-defined container or create our own and insert it right after the seat chart div
			var $container = (legend.node || $('<div></div').insertAfter(fn))
				.addClass('seatCharts-legend');
				
			var $ul = $('<ul></ul>')
				.addClass('seatCharts-legendList')
				.appendTo($container);
			
			$.each(legend.items, function(index, item) {
				$ul.append(
					$('<li></li>')
						.addClass('seatCharts-legendItem')
						.append(
							$('<div></div>')
								//merge user defined classes with our standard ones
								.addClass(['seatCharts-seat', 'seatCharts-cell', item[1]].concat(
									settings.classes, 
									typeof settings.seats[item[0]] == "undefined" ? [] : settings.seats[item[0]].classes).join(' ')
								)
						)
						.append(
							$('<span></span>')
								.addClass('seatCharts-legendDescription')
								.text(item[2])
						)
				);
			});
			
			return $container;
		})(settings.legend) : null;
	
		fn.attr({
			tabIndex : 0
		});
		
		
		//when container's focused, move focus to the first seat
		fn.focus(function() {
			if (fn.attr('aria-activedescendant')) {
				seats[fn.attr('aria-activedescendant')].blur();
			}
				
			fn.find('.seatCharts-seat:not(.seatCharts-space):first').focus();
			seats[seatIds[0]].focus();

		});
	
		//public methods of seatCharts
		fn.data('seatCharts', {
			seats   : seats,
			seatIds : seatIds,
			//set for one, set for many, get for one
			status: function() {
				var fn = this;
				return arguments.length == 1 ? fn.seats[arguments[0]].status() : (function(seatsIds, newStatus) {
				
					return typeof seatsIds == 'string' ? fn.seats[seatsIds].status(newStatus) : (function() {
						$.each(seatsIds, function(index, seatId) {
							fn.seats[seatId].status(newStatus);
						});
					})();
				})(arguments[0], arguments[1]);
			},
			each  : function(callback) {
				var fn = this;
			
				for (var seatId in fn.seats) {
					if (false === callback.call(fn.seats[seatId], seatId)) {
						return seatId;//return last checked
					}
				}
				
				return true;
			},
			node       : function() {
				var fn = this;
				//basically create a CSS query to get all seats by their DOM ids
				return $('#' + fn.seatIds.join(',#'));
			},

			find       : function(query) {//D, a.available, unavailable
				var fn = this;
			
				var seatSet = fn.set();
			
				//user searches just for a particual character
				return query.length == 1 ? (function(character) {
					fn.each(function() {
						if (this.char() == character) {
							seatSet.push(this.settings.id, this);
						}
					});
					
					return seatSet;
				})(query) : (function() {
					//user runs a more sophisticated query, so let's see if there's a dot
					return query.indexOf('.') > -1 ? (function() {
						//there's a dot which separates character and the status
						var parts = query.split('.');
						
						fn.each(function(seatId) {
							if (this.char() == parts[0] && this.status() == parts[1]) {
								seatSet.push(this.settings.id, this);
							}
						});
						
						return seatSet;
					})() : (function() {
						fn.each(function() {

							if (this.status() == query) {
								seatSet.push(this.settings.id, this);
							}
						});
						
						return seatSet;
					})();
				})();
				
			},
			set        : function set() {//inherits some methods
				var fn = this;
				
				return {
					seats      : [],
					seatIds    : [],
					length     : 0,
					status     : function() {
						var args = arguments,
							that = this;
						//if there's just one seat in the set and user didn't pass any params, return current status
						return this.length == 1 && args.length == 0 ? this.seats[0].status() : (function() {
							//otherwise call status function for each of the seats in the set
							$.each(that.seats, function() {
								this.status.apply(this, args);
							});
						})();
					},
					node       : function() {
						return fn.node.call(this);
					},
					each       : function() {
						return fn.each.call(this, arguments[0]);
					},
					get        : function() {
						return fn.get.call(this, arguments[0]);
					},
					find       : function() {
						return fn.find.call(this, arguments[0]);
					},
					set       : function() {
						return set.call(fn);
					},
					push       : function(id, seat) {
						this.seats.push(seat);
						this.seatIds.push(id);
						++this.length;
					}
				};
			},
			//get one object or a set of objects
			get   : function(seatsIds) {
				var fn = this;

				return typeof seatsIds == 'string' ? 
					fn.seats[seatsIds] : (function() {
						
						var seatSet = fn.set();
						
						$.each(seatsIds, function(index, seatId) {
							if (typeof fn.seats[seatId] === 'object') {
								seatSet.push(seatId, fn.seats[seatId]);
							}
						});
						
						return seatSet;
					})();
			}
		});
		
		return fn.data('seatCharts');
	}
	
	
})(jQuery);