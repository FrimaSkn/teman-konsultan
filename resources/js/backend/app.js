import 'bootstrap';

import $ from 'jquery';
import select2 from 'select2';
import Swal from 'sweetalert2';
import '~@coreuijs';
import Datepicker from 'bootstrap-datepicker';
import moment from 'moment';


window.$ = window.jQuery = $;
window.Swal = Swal;
select2($);
window.Datepicker = Datepicker;
window.moment = moment;
