import _ from 'lodash';
import Swal from 'sweetalert2';
import Popper from 'popper.js';
import jQuery from 'jquery';
window.$ = jQuery;
import 'bootstrap';
import axios from 'axios';

window._ = _;

window.Swal = Swal;

window.Popper = Popper;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';
// window.Pusher = Pusher;
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
