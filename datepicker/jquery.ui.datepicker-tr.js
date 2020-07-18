jQuery(function($){
	$.datepicker.regional['tr'] = {
		closeText: 'kapat',
		prevText: '&#x3C;geri',
		nextText: 'ileri&#x3e',
		currentText: 'bug�n',
		monthNames: ['Ocak','&#350;ubat','Mart','Nisan','May&#305;s','Haziran',
		'Temmuz','A&#287;ustos','Eyl&#252;l','Ekim','Kas&#305;m','Aral&#305;k'],
		monthNamesShort: ['Oca','�ub','Mar','Nis','May','Haz',
		'Tem','A�u','Eyl','Eki','Kas','Ara'],
		dayNames: ['Pazar','Pazartesi','Sal&#305;','�ar�amba','Per�embe','Cuma','Cumartesi'],
		dayNamesShort: ['Pz','Pt','Sa','&#199;a','Pe','Cu','Ct'],
		dayNamesMin: ['Pz','Pt','Sa','&#199;a','Pe','Cu','Ct'],
		weekHeader: 'Hf',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['tr']);
});