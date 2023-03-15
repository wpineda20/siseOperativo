import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const axisApi = axios.create({
    baseURL: "/api/web/axis",
});

// axisApi.interceptors.request.use(interceptorRequest);
// axisApi.interceptors.response.reject(interceptorReponse);

export default axisApi;
