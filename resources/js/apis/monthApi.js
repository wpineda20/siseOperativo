import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const monthApi = axios.create({
    baseURL: "/api/web/month",
});

// monthApi.interceptors.request.use(interceptorRequest);
// monthApi.interceptors.response.reject(interceptorReponse);

export default monthApi;
