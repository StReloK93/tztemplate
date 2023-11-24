import axios from "axios"
import { echo } from "./echo"
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.withCredentials = true
axios.defaults.baseURL = '/api/'
axios.defaults.headers.common['X-Socket-Id'] = echo.socketId();

export default axios