import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const periodApi = axios.create({
    baseURL: "/api/web/period",
});

// periodApi.interceptors.request.use(interceptorRequest);
// periodApi.interceptors.response.reject(interceptorReponse);

export default periodApi;
