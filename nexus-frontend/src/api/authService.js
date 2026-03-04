import client from "./client"

export const register = (userData) => {
    return client.post('/register', userData);
}

export const login = (credentials) => {
       return client.post('/login', credentials);
}

export const logout = () => {
    return client.post('/logout');
}