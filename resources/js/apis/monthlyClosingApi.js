import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const monthlyClosingApi = axios.create({
    baseURL: "/api/web/monthlyClosing",
});

// monthlyClosingApi.interceptors.request.use(interceptorRequest);
// monthlyClosingApi.interceptors.response.reject(interceptorReponse);

export default monthlyClosingApi;
