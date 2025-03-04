import axios from 'axios';
import interact from 'interactjs'

window.axios = axios;
window.interact = interact

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
