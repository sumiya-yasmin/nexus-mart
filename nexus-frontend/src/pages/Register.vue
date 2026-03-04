<script setup>
import AuthForm from "@/components/AuthForm.vue";
import { useAuthStore } from "@/store/auth";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
const authStore = useAuthStore();
const router = useRouter();
const toast = useToast();
const handleRegister = async (data) => {
  try {
    await authStore.register(data);
    toast.success(`Welcome to NexusMart! Registration Successful`, {
      timeout: 2000,
      position: "top-right",
    });
    router.push("/");
  } catch (error) {
    alert("Registration failed", error);
  }
};
</script>

<template>
  <div class="mt-8">
    <AuthForm mode="register" @submit="handleRegister" />
  </div>
</template>
