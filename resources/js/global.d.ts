import Echo from "laravel-echo"
import { AxiosStatic } from "axios"

declare global {
    var echo: Echo;
    var axios: AxiosStatic;
}