import axios from "axios";
const axiosinstance = axios.create({
    baseURL: "/api",
    // headers: {
    //     Accept: "application/vnd.github.v3+json"
    // }
})

axiosinstance.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            // Handle unauthorized request
            console.error("Unauthorized request");
        } else if (error.response.status === 404) {
            // Handle not found error
            console.error("Not found error");
        } else {
            // Handle other errors
            console.error("An error occurred:", error.message);
        }
        return Promise.reject(error);
    }
)

export default axiosinstance;