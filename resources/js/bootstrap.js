import * as Popper from '@popperjs/core';
import 'bootstrap';
import axios from 'axios';
window.Popper = Popper;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
