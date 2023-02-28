import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const trackingStatusApi = axios.create({
    baseURL: "/api/web/trackingStatus",
});

// trackingStatusApi.interceptors.request.use(interceptorRequest);
// trackingStatusApi.interceptors.response.reject(interceptorReponse);

export default trackingStatusApi;
