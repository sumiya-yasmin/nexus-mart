<script setup>
import AuthForm from "@/components/AuthForm.vue";
import { useAuthStore } from "@/store/auth";
import { useRoute, useRouter } from "vue-router";
import { useToast } from "vue-toastification";

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const toast = useToast();
const handleLogin = async (data) => {
  try {
    await authStore.login(data);
    toast.success(`Login successful`, {
      timeout: 2000,
      position: "top-right",
    });
    const redirectPath = route.query.redirect || "/";
    router.push(redirectPath);
  } catch (error) {
    alert("Login failed", error);
  }
};
</script>
<template>
  <div class="mt-8">
    <AuthForm mode="login" @submit="handleLogin" />
  </div>
</template>
