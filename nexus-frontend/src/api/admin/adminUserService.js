import client from "../client";

export const getAllUsers = async () => {
    const response = await client.get('/admin/users');
    return response.data;
};

export const updateUser = async (userId, userData) => {
    const response = await client.patch(`/admin/users/${userId}`, userData);
    return response.data;
};

export const deleteUser = async (userId) => {
    const response = await client.delete(`/admin/users/${userId}`);
    return response.data;
};
