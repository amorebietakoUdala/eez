import '../../scss/quota/list.scss';

import $ from 'jquery';
import 'bootstrap-table';
import 'tableexport.jquery.plugin';
import 'bootstrap-table/dist/extensions/export/bootstrap-table-export'
import 'bootstrap-table/dist/locale/bootstrap-table-es-ES';
import 'bootstrap-table/dist/locale/bootstrap-table-eu-EU';
import 'bootstrap-datepicker';
import 'bootstrap-datepicker/js/locales/bootstrap-datepicker.es';
import 'bootstrap-datepicker/js/locales/bootstrap-datepicker.eu';
import 'eonasdan-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker';
import moment from 'moment';

import {createConfirmationAlert} from '../common/alert';
const routes = require('../../../public/js/fos_js_routes.json');
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

function dateFormat(value, row, index) {
    if ( value !== null ) {
        return moment(value).format('YYYY-MM-DD HH:mm');
    }
    else {
        return '';
    }
}

$(document).ready(function(){
    $('.js-datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		sideBySide: false,
		locale: $('html').attr('lang'),
	});    
    
    $('#taula').bootstrapTable({
        cache : false,
        showExport: true,
        exportTypes: ['excel'],
        exportDataType: 'all',
        undefinedText: '',
        exportOptions: {
            fileName: "expedients",
            ignoreColumn: ['options']
        },
        showColumns: false,
        pagination: true,
		sidePagination: 'server',
		url: 'http://garapenak/eez/api/expedient',
        search: true,
        striped: true,
        sortStable: true,
        pageSize: 10,
        pageList: [10,25,50,100],
        sortable: true,
        locale: $('html').attr('lang')+'-'+$('html').attr('lang').toUpperCase(),
   });
    var $table = $('#taula');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('destroy').bootstrapTable({
                exportDataType: $(this).val()
            });
        });
    });
	$(document).on('click','.js-delete',function(e){
		e.preventDefault();
		var url = e.currentTarget.dataset.url;
		createConfirmationAlert(url);
	});
    $(document).on('click','#btnSearch',function(e){
        e.preventDefault();
        console.log(e.currentTarget);
        document.expedient_search.submit();
    });
    
});
