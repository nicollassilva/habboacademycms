import axios from 'axios';

const Axios = axios.create({
    baseURL: 'http://localhost/',
    timeout: 5000
});

export default Axios;