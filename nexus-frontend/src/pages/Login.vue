<script setup>
import AuthForm from "@/components/AuthForm.vue";
import { useAuthStore } from "@/store/auth";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();
const handleLogin = async(data) => {
    try {
        await authStore.login(data);
        router.push('/');
    } catch (error) {
        alert('Login failed', error);

    }
}
</script>
<template>
  <div class="mt-8">
    <AuthForm mode="login" @submit="handleLogin" />
  </div>
</template>
