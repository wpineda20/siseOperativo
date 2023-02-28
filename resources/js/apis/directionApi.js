import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const directionApi = axios.create({
    baseURL: "/api/web/direction",
});

// directionApi.interceptors.request.use(interceptorRequest);
// directionApi.interceptors.response.reject(interceptorReponse);

export default directionApi;
