import client from "./client"

export const createPayment = (payload) => {
     return client.post('/bkash/create-payment', payload)
}