import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const yearApi = axios.create({
    baseURL: "/api/web/year",
});

// yearApi.interceptors.request.use(interceptorRequest);
// yearApi.interceptors.response.reject(interceptorReponse);

export default yearApi;
