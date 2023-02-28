import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const organizationalUnitApi = axios.create({
    baseURL: "/api/web/organizationalUnit",
});

// organizationalUnitApi.interceptors.request.use(interceptorRequest);
// organizationalUnitApi.interceptors.response.reject(interceptorReponse);

export default organizationalUnitApi;
