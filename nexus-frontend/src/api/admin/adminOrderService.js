import client from "../client";

export const getAllOrders = async () =>
{
    return await client.get('/admin/orders');
}
export const updateOrderStatus =async(orderId, status)=>{
    return client.patch(`/admin/orders/${orderId}/status`, {status});
}

export const updateOrderPaymentStatus =  async(orderId, paymentStatus) =>{
    return client.patch(`/admin/orders/${orderId}/payment_status`, {payment_status: paymentStatus});
}