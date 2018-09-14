//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions

	// demo initializer
	var demo = function () {

		var dataJSONArray = JSON.parse('[{"RecordID":1,"OrderID":"54473-251","ShipCountry":"GT","ShipCity":"San Pedro Ayampuc","ShipName":"Sanford-Halvorson","ShipAddress":"897 Magdeline Park","CompanyEmail":"sgormally0@dot.gov","CompanyAgent":"Shandra Gormally","CompanyName":"Eichmann, Upton and Homenick","Currency":"GTQ","Notes":"sit amet cursus id turpis integer aliquet massa id lobortis convallis","Department":"Computers","Website":"house.gov","Latitude":"14.78667","Longitude":"-90.45111","ShipDate":"5/21/2016","TimeZone":"America/Guatemala","Status":1,"Type":2},{"RecordID":2,"OrderID":"41250-308","ShipCountry":"ID","ShipCity":"Langensari","ShipName":"Denesik-Langosh","ShipAddress":"9 Brickson Park Junction","CompanyEmail":"eivanonko1@over-blog.com","CompanyAgent":"Estele Ivanonko","CompanyName":"Lowe, Batz and Purdy","Currency":"IDR","Notes":"lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in imperdiet","Department":"Baby","Website":"arizona.edu","Latitude":"-6.4222","Longitude":"105.9425","ShipDate":"4/19/2016","TimeZone":"Asia/Jakarta","Status":1,"Type":3},{"RecordID":3,"OrderID":"0615-7571","ShipCountry":"HR","ShipCity":"Slatina","ShipName":"Kunze, Schneider and Cronin","ShipAddress":"35712 Sundown Parkway","CompanyEmail":"sbettley2@gmpg.org","CompanyAgent":"Stephine Bettley","CompanyName":"Bernier, Weimann and Wuckert","Currency":"HRK","Notes":"cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus","Department":"Toys","Website":"rakuten.co.jp","Latitude":"45.70333","Longitude":"17.70278","ShipDate":"4/7/2016","TimeZone":"Europe/Zagreb","Status":6,"Type":3},{"RecordID":4,"OrderID":"49349-551","ShipCountry":"RU","ShipCity":"Novo-Peredelkino","ShipName":"Jacobi-Ankunding","ShipAddress":"481 Sage Park","CompanyEmail":"dmartijn3@printfriendly.com","CompanyAgent":"Damara Martijn","CompanyName":"Tromp-Hegmann","Currency":"RUB","Notes":"cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam","Department":"Baby","Website":"t-online.de","Latitude":"55.64528","Longitude":"37.33583","ShipDate":"2/15/2016","TimeZone":"Europe/Moscow","Status":4,"Type":2},{"RecordID":5,"OrderID":"59779-750","ShipCountry":"ID","ShipCity":"Bombu","ShipName":"Johns-Kunze","ShipAddress":"59 Marcy Hill","CompanyEmail":"hpelzer4@friendfeed.com","CompanyAgent":"Helsa Pelzer","CompanyName":"Walker LLC","Currency":"IDR","Notes":"non ligula pellentesque ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit","Department":"Toys","Website":"xrea.com","Latitude":"-8.6909","Longitude":"120.5162","ShipDate":"1/30/2017","TimeZone":"Asia/Makassar","Status":4,"Type":3},{"RecordID":6,"OrderID":"63777-145","ShipCountry":"CN","ShipCity":"Kaiyuan","ShipName":"Kris, Keeling and Weimann","ShipAddress":"122 Evergreen Street","CompanyEmail":"sheugel5@mysql.com","CompanyAgent":"Sigismundo Heugel","CompanyName":"D\'Amore-Johnston","Currency":"CNY","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in","Department":"Tools","Website":"gravatar.com","Latitude":"42.53306","Longitude":"124.04028","ShipDate":"10/22/2016","TimeZone":"Asia/Harbin","Status":3,"Type":3},{"RecordID":7,"OrderID":"57520-0136","ShipCountry":"GR","ShipCity":"Tríkala","ShipName":"Effertz Inc","ShipAddress":"328 8th Avenue","CompanyEmail":"cewell6@reverbnation.com","CompanyAgent":"Clarinda Ewell","CompanyName":"Jakubowski and Sons","Currency":"EUR","Notes":"magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien","Department":"Music","Website":"msu.edu","Latitude":"40.59814","Longitude":"22.55733","ShipDate":"9/3/2016","TimeZone":"Europe/Athens","Status":4,"Type":1},{"RecordID":8,"OrderID":"0093-5200","ShipCountry":"SE","ShipCity":"Köping","ShipName":"West-Ullrich","ShipAddress":"48 Sommers Junction","CompanyEmail":"adevenny7@webnode.com","CompanyAgent":"Ariel Devenny","CompanyName":"Goldner, Bartoletti and Towne","Currency":"SEK","Notes":"mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus","Department":"Jewelery","Website":"flavors.me","Latitude":"59.514","Longitude":"15.9926","ShipDate":"2/10/2016","TimeZone":"Europe/Stockholm","Status":2,"Type":3},{"RecordID":9,"OrderID":"14783-319","ShipCountry":"ID","ShipCity":"Ujung","ShipName":"Stiedemann-Kemmer","ShipAddress":"10625 Dixon Road","CompanyEmail":"bplewright8@mashable.com","CompanyAgent":"Buck Plewright","CompanyName":"Boyer and Sons","Currency":"IDR","Notes":"habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum","Department":"Music","Website":"odnoklassniki.ru","Latitude":"-8.2137","Longitude":"114.3818","ShipDate":"11/11/2016","TimeZone":"Asia/Makassar","Status":2,"Type":3}]');

		var datatable = $('.m_datatable').mDatatable({
			// datasource definition
			data: {
				type: 'local',
				source: dataJSONArray,
				pageSize: 10
			},

			// layout definition
			layout: {
				theme: 'default', // datatable theme
				class: '', // custom wrapper class
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				height: 450, // datatable's body's fixed height
				footer: false // display/hide footer
			},

			// column sorting(refer to Kendo UI)
			sortable: true,

			// column based filtering(refer to Kendo UI)
			filterable: false,

			pagination: true,

			// inline and bactch editing(cooming soon)
			// editable: false,

			// columns definition
			columns: [{
				field: "RecordID",
				title: "#",
				width: 50,
				sortable: false,
				selector: false,
				textAlign: 'center'
			}, {
				field: "OrderID",
				title: "Order ID"
			}, {
				field: "ShipName",
				title: "Ship Name",
				responsive: {visible: 'lg'}
			}, {
				field: "Currency",
				title: "Currency",
				width: 100
			}, {
				field: "ShipAddress",
				title: "Ship Address",
				responsive: {visible: 'lg'}
			}, {
				field: "ShipDate",
				title: "Ship Date"
			}, {
				field: "Status",
				title: "Status",
				// callback function support for column rendering
				template: function (row) {
					var status = {
						1: {'title': 'Pending', 'class': 'm-badge--brand'},
						2: {'title': 'Delivered', 'class': ' m-badge--metal'},
						3: {'title': 'Canceled', 'class': ' m-badge--primary'},
						4: {'title': 'Success', 'class': ' m-badge--success'},
						5: {'title': 'Info', 'class': ' m-badge--info'},
						6: {'title': 'Danger', 'class': ' m-badge--danger'},
						7: {'title': 'Warning', 'class': ' m-badge--warning'}
					};
					return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
				}
			}, {
				field: "Type",
				title: "Type",
				// callback function support for column rendering
				template: function (row) {
					var status = {
						1: {'title': 'Online', 'state': 'danger'},
						2: {'title': 'Retail', 'state': 'primary'},
						3: {'title': 'Direct', 'state': 'accent'}
					};
					return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
				}
			}, {
				field: "Actions",
				width: 110,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row) {
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

					return '\
						<div class="dropdown '+ dropup +'">\
							<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
						  	</div>\
						</div>\
						<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View ">\
                            <i class="la la-edit"></i>\
                        </a>\
					';
				}
			}]
		});

		var query = datatable.getDataSourceQuery();

		$('#m_form_search').on('keyup', function (e) {
			datatable.search($(this).val().toLowerCase());
		}).val(query.generalSearch);

		$('#m_form_status').on('change', function () {
			datatable.search($(this).val(), 'Status');
		}).val(typeof query.Status !== 'undefined' ? query.Status : '');

		$('#m_form_type').on('change', function () {
			datatable.search($(this).val(), 'Type');
		}).val(typeof query.Type !== 'undefined' ? query.Type : '');

		$('#m_form_status, #m_form_type').selectpicker();

	};

	return {
		//== Public functions
		init: function () {
			// init dmeo
			demo();
		}
	};
}();

jQuery(document).ready(function () {
	DatatableDataLocalDemo.init();
});