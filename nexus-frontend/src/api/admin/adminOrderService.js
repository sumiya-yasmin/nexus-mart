import client from "../client";

export const getAllOrders = async () => {
  const response = await client.get("/admin/orders");
  return response.data;
};
export const updateOrderStatus = async (orderId, status) => {
  const response = client.patch(`/admin/orders/${orderId}/status`, { status });
  return response.data;
};

export const updateOrderPaymentStatus = async (orderId, paymentStatus) => {
  const response = client.patch(`/admin/orders/${orderId}/payment_status`, {
    payment_status: paymentStatus,
  });
  return response.data;
};
