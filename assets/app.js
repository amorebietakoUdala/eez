import $ from 'jquery';

import './bootstrap';

import 'bootstrap';
import 'popper.js';

import '@fortawesome/fontawesome-free/js/all.js';

//global.app_base = '/eez';
global.$ = $;
global.locale = $('html').attr("lang");
global.jQuery = $;

import './css/app.css';

$(document).ready(function(){
	$('.js-back').on('click',function(e){
		e.preventDefault();
		var url = e.currentTarget.dataset.url;
		document.location.href=url;
	});
});