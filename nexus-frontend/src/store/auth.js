import { defineStore } from "pinia";
import { computed, ref } from "vue";
import * as authApi from "@/api/authService";
import { useRouter } from "vue-router";
export const useAuthStore = defineStore("auth", () => {
  const user = ref(JSON.parse(localStorage.getItem("user")) || null);
  const token = ref(localStorage.getItem("token") || null);

  const isLoggedIn = computed(() => !!token.value);
  const isAdmin = computed(() => {
    return user.value?.role === "admin";
  });

  const login = async (credentials) => {
    try {
        const response = await authApi.login(credentials);
      user.value = response.data.user;
      token.value = response.data.token;
      localStorage.setItem("user", JSON.stringify(user.value));
      localStorage.setItem("token", token.value);
      return response;
    } catch (error) {
      throw error;
    }
  };

  const register = async (userData) => {
    try {
      const response = await authApi.register(userData);
      user.value = response.data.user;
      token.value = response.data.token;
      localStorage.setItem("user", JSON.stringify(user.value));
      localStorage.setItem("token", token.value);
    } catch (error) {
      throw error;
    }
  };

  const logout = async () => {
    try {
      await authApi.logout();
    } catch (error) {
      console.error("Backend logout failed or token already expired", error);
    } finally {
      user.value = null;
      token.value = null;
      localStorage.removeItem('user');
      localStorage.removeItem('token');
    }
  }
    return {
        user, token, isLoggedIn, isAdmin, login,register, logout
    }
});
