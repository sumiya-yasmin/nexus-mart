<script setup>
import AuthForm from '@/components/AuthForm.vue';
import { useAuthStore } from '@/store/auth';
import { useRouter } from 'vue-router';
const authStore = useAuthStore();
const router = useRouter();
const handleRegister = async(data) => {
    try {
        await authStore.register(data);
        router.push('/');
    } catch (error) {
        alert('Registration failed', error);
    }
}
</script>

<template>
    <div class="mt-8">
        <AuthForm 
         mode="register"
         @submit="handleRegister"
        />
    </div>
</template>