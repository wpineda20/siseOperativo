import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const unitApi = axios.create({
    baseURL: "/api/web/unit",
});

// unitApi.interceptors.request.use(interceptorRequest);
// unitApi.interceptors.response.reject(interceptorReponse);

export default unitApi;
