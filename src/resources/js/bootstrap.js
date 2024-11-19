import axios from 'axios';
import './bootstrap';
import '../css/app.css';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
