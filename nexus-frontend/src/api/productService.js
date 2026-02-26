import client from "./client";

export const fetchProducts = () => client.get('/products');
