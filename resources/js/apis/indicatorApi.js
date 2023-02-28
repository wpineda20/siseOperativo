import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const indicatorApi = axios.create({
    baseURL: "/api/web/indicator",
});

// indicatorApi.interceptors.request.use(interceptorRequest);
// indicatorApi.interceptors.response.reject(interceptorReponse);

export default indicatorApi;
