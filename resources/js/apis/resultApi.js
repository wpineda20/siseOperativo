import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const resultApi = axios.create({
    baseURL: "/api/web/result",
});

// resultApi.interceptors.request.use(interceptorRequest);
// resultApi.interceptors.response.reject(interceptorReponse);

export default resultApi;
