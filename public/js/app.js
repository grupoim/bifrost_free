var baseUrl = "http://192.168.10.249/";

function Notification(settings){
	this.settings = settings;
	this.interval;
	this.init();
}

Notification.prototype.init = function(){
	this.getTotal();
	var caller = this;
	$(this.settings.target).on('click', function(){
		caller.getDetail();
	});
}

Notification.prototype.start = function(){
	var caller = this;
	this.interval = setInterval(function(){
		caller.getTotal();
	}, 10000);
}

Notification.prototype.showTotal = function(count){
	var target = $(this.settings.target + ' > span');
	target.html(count);
	if(count > 0){
		target.removeClass().addClass('label label-' + this.settings.label);
	}else{
		target.removeClass().addClass('label label-default');
	}
}

Notification.prototype.showDetail = function(result){
	$(this.settings.target + ' + ul > .dynamic').remove();
	var caller = this;
	var jsonResult = result;//$.parseJSON(result);
	if(jsonResult.length > 0){
		$.each(jsonResult, function(index, object){
			$(caller.settings.target + ' + ul > li:first').after('<li class="dynamic"> ' 
				+'<h6><a href="' + caller.settings.link + object.id + '"><i class="fa fa-calendar"></i> ' + new Date(object[caller.settings.display]).toLocaleDateString() +  '</a></h6>'
				+'<p>'  + object[caller.settings.description] +  '</p>'
				+ '<hr />'
				+ '</li>');
		});
	}
}

Notification.prototype.stop = function(){
	clearInterval(this.interval);
}

Notification.prototype.error = function(){

}

Notification.prototype.getDetail = function(){
	var caller = this;
	$(caller.settings.target + ' + ul > .dynamic').remove();
	$(caller.settings.target + '+ ul > li:first').after('<li class="dynamic">'
		+ '<div class="center">'
		+ '<i class="fa fa-spinner fa-pulse fa-2x"></i>'
		+ '</div>'
		+ '</li>');
	$.ajax(this.settings.urlDetail)
	.done(function(result){
		if(result){
			caller.showDetail(result);
		}else{
			$(caller.settings.target + ' + ul > .dynamic').remove();
			$(caller.settings.target + '+ ul > li:first').after('<li class="dynamic">'
				+ '<div class="alert alert-info">Sin resultados.</div><hr />'
				+ '</li>');
		}
	})
	.fail(function(){

	})
	.always(function(){

	});
}

Notification.prototype.getTotal = function(){
	var caller = this;
	$.ajax(this.settings.urlTotal)
	.done(function(result){
		caller.showTotal(result.total);
	})
	.fail(function(){

	})
	.always(function(){

	});
}

function DropdownProgress(settings){
	this.settings = settings;
	this.init();
}

DropdownProgress.prototype.init = function(){
	var caller = this;
	caller.load();
	setInterval(function(){
		caller.load();
	}, 10000);
}

DropdownProgress.prototype.load = function(){
	var caller = this;
	$.ajax(this.settings.url)
	.done(function(result){
		caller.show(result);
	})
	.fail(function(){

	})
	.always(function(){

	});
}

DropdownProgress.prototype.getClass = function(percentaje){
	var classes = ['default', 'danger', 'warning', 'success'];
	var index = 0;
	if(percentaje >= 25 && percentaje < 50){
		index = 1;
	}else if(percentaje >= 50 && percentaje < 75){
		index = 2;
	}else if(percentaje >= 75 && percentaje <= 100){
		index = 3;
	}
	return classes[index];
}

DropdownProgress.prototype.show = function(result){
	var bar = $(this.settings.target + ' > div > div');
	bar.attr('aria-valuenow', result[this.settings.percentaje]);
	$(this.settings.target + ' p').html(result[this.settings.title] + ': ' + result[this.settings.value] + ' de ' +  result[this.settings.total]);
	bar.removeClass().addClass('progress-bar progress-bar-' + this.getClass(result[this.settings.percentaje]));
	bar.css({
		'width': result[this.settings.percentaje] + '%'
	});
}
//Set Dropdown progress

var cobranzaMes = new DropdownProgress({
	target: '#cobranza-mes',
	url: baseUrl + 'cobranza/estadisticosmes',
	total: 'esperado',
	value: 'cobrado',
	percentaje: 'porcentaje',
	title: 'nombre'
});

var cobranzaDia = new DropdownProgress({
	target: '#cobranza-dia',
	url: baseUrl + 'cobranza/estadisticosdia',
	total: 'esperado',
	value: 'cobrado',
	percentaje: 'porcentaje',
	title: 'nombre'
});

// Set the notifications

var quejas = new Notification({
	target: '#notificacion_queja',
	urlTotal: baseUrl + 'queja/total',
	urlDetail: baseUrl  + 'queja/all',
	link: baseUrl + 'queja/recupera/',
	label: 'danger',
	display: 'created_at',
	description: 'descripcion'
}).start();

var cotizaciones = new Notification({
	target: '#notificacion_cotizacion',
	urlTotal: baseUrl + 'cotizacion/total',
	urlDetail: baseUrl  + 'cotizacion/all',
	link: baseUrl  + 'contizacion/index/',
	label: 'success',
	display: 'fecha',
	description: 'nombre'
}).start();

$(document).on('ready', function(){
	$.ajax(baseUrl + "persona/all")
	.success(function(data){
		$('#buscador').typeahead({
			source: data,
			display: 'nombre',
			itemSelected: function(item){
				alert(item);
			}
		});

		$('.buscapersonas').typeahead({
			source: data,
			display: 'nombre',
			itemSelected: function(item){
				window.location.replace(baseUrl  + "cliente/edit/" + item);
			}
		});
	});
	$.ajax(baseUrl + "venta/estadisticos")
	.success(function(data){
		$('#estadisticos-ventas > a').html('Ventas');
		$('#estadisticos-ventas > em').html('$ ' + data.ventas);

		$('#estadisticos-ingresos > a').html('Ingresos');
		$('#estadisticos-ingresos > em').html('$ ' + data.ingresos);
	});

});




