import client from "../client";

export const fetchOrders = async () =>
{
    return await client.get('/admin/orders');
}
export const updateStatus =async(orderId, status)=>{
    return client.patch(`/admin/orders/${orderId}/status`, {status});
}

export const updatePaymentStatus =  async(orderId, paymentStatus) =>{
    return client.patch(`/admin/orders/${orderId}/payment_status`, {payment_status: paymentStatus});
}