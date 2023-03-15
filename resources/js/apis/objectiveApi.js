import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const objectiveApi = axios.create({
    baseURL: "/api/web/objective",
});

// objectiveApi.interceptors.request.use(interceptorRequest);
// objectiveApi.interceptors.response.reject(interceptorReponse);

export default objectiveApi;
