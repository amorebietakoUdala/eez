import '../../scss/quota/list.scss';

// Added to app.js
// import $ from 'jquery';
// global.jQuery = $;
import 'bootstrap-table';
import 'tableexport.jquery.plugin';
import 'bootstrap-table/dist/extensions/export/bootstrap-table-export'
import 'bootstrap-table/dist/locale/bootstrap-table-es-ES';
import 'bootstrap-table/dist/locale/bootstrap-table-eu-EU';
import tempusDominus from '@eonasdan/tempus-dominus';
import customDateFormat from '@eonasdan/tempus-dominus/dist/plugins/customDateFormat';

import {
    createConfirmationAlert
} from '../common/alert';
const routes = require('../../../public/js/fos_js_routes.json');
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
var current_locale = $('html').attr("lang");

$(document).ready(function () {
    $('.js-datetimepicker').each((i,v) => {
        tempusDominus.extend(customDateFormat);
        new tempusDominus.TempusDominus(v,{
            display: {
              buttons: {
                close: true,
                clear: true,
              },
              components: {
                useTwentyfourHour: true,
                decades: false,
                year: true,
                month: true,
                date: true,
                clock: false,
              },
            },
            debug: true,
            localization: {
              locale: current_locale+'-'+current_locale.toUpperCase(),
              dayViewHeaderFormat: { month: 'long', year: 'numeric' },
              format: 'yyyy-MM-dd',
            },
        });
    });

    $('#taula').bootstrapTable({
        cache: false,
        showExport: true,
        exportTypes: ['excel'],
        exportDataType: 'all',
        exportOptions: {
            fileName: "concepts",
            ignoreColumn: ['options']
        },
        showColumns: false,
        pagination: true,
        search: true,
        striped: true,
        sortStable: true,
        pageSize: 10,
        pageList: [10, 25, 50, 100],
        sortable: true,
        locale: $('html').attr('lang') + '-' + $('html').attr('lang').toUpperCase()
    });
    var $table = $('#taula');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('destroy').bootstrapTable({
                exportDataType: $(this).val()
            });
        });
    });
    $(document).on('click', '.js-delete', function (e) {
        e.preventDefault();
        var url = e.currentTarget.dataset.url;
        createConfirmationAlert(url);
    });
    $(document).on('click', '#btnSearch', function (e) {
        e.preventDefault();
        console.log(e.currentTarget);
        document.quota_search.submit();
    });
});