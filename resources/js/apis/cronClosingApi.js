import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const cronClosingApi = axios.create({
    baseURL: "/api/web/cronClosing",
});

// cronClosingApi.interceptors.request.use(interceptorRequest);
// cronClosingApi.interceptors.response.reject(interceptorReponse);

export default cronClosingApi;
