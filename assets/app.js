import $ from 'jquery';

import './bootstrap';

import 'bootstrap';
import 'popper.js';

import '@fortawesome/fontawesome-free/js/all.js';

//global.app_base = '/eez';
global.$ = $;
global.locale = $('html').attr("lang");
global.jQuery = $;

import './scss/app.scss';

$(document).ready(function(){
    $('#js-locale-es').on('click',function (e) {
		e.preventDefault();
		var current_locale = $('html').attr("lang");
		if ( current_locale === 'es') {
			return;
		}
		var location = window.location.href;
		var location_new = location.replace("/eu/","/es/");
		window.location.href=location_new;
    });
    $('#js-locale-eu').on('click',function (e) {
		e.preventDefault();
		var current_locale = $('html').attr("lang");
		if ( current_locale === 'eu') {
			return;
		}
		var location = window.location.href;
		var location_new = location.replace("/es/","/eu/");
		window.location.href=location_new;
    });
	$('.js-back').on('click',function(e){
		e.preventDefault();
		var url = e.currentTarget.dataset.url;
		document.location.href=url;
	});
});