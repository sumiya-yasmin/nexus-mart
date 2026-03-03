import { useAuthStore } from "@/store/auth";
import axios from "axios";
const client = axios.create({
    baseURL: 'http://localhost/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});
client.interceptors.request.use((config) => {
    const authStore = useAuthStore();
    if (authStore.token) {
        config.headers.Authorization = `Bearer ${authStore.token}`;
    }
    return config;
}, (error) => {
    return Promise.reject(error);
});

export default client;
