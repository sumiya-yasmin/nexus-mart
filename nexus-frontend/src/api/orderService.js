import client from "./client";

export const createOrder = (orderData) => client.post('/orders', orderData);
export const getOrders = () => client.get('/orders');