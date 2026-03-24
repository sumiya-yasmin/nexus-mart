import { createPayment } from "@/api/bkashPaymentService";

export function useBkashPayment() {
    
    const createBkashPayment = async (payload) => {
  try {
    const response = await createPayment(payload);
    return response.data;
  } catch (error) {
    console.error("Payment Service Error:", error);
    throw error;
  }
    }
    return { createBkashPayment };
};

