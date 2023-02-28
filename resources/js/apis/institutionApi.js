import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const institutionApi = axios.create({
    baseURL: "/api/web/institution",
});

// institutionApi.interceptors.request.use(interceptorRequest);
// institutionApi.interceptors.response.reject(interceptorReponse);

export default institutionApi;
