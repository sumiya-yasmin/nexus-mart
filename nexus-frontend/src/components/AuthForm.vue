<script setup>
import { Eye, EyeOff } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps(["mode", "errors"]);
const emit = defineEmits(["submit"]);
const form = ref({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);
</script>
<template>
  <div class="flex flex-col items-center justify-center min-h-[50vh]">
    <div
      class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-gray-50"
    >
      <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8">
        {{ mode === "login" ? "Sign In" : "Create Account" }}
      </h2>

      <form @submit.prevent="emit('submit', form)" class="space-y-6">
        <div v-if="mode === 'register'">
          <label class="block text-sm font-semibold text-gray-600 mb-1"
            >Full Name</label
          >
          <input
            v-model="form.name"
            type="text"
            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
            placeholder="Mohammad Sadman"
          />
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-600 mb-1"
            >Email Address</label
          >
          <input
            v-model="form.email"
            type="email"
            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
            placeholder="name@company.com"
          />
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-600 mb-1"
            >Password</label
          >
          <div class="relative">
            <input
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
              placeholder="••••••••"
            />
            <button
              @click="showPassword = !showPassword"
              type="button"
              class="absolute cursor-pointer right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors"
            >
              <Eye v-if="showPassword" :size="20" />
              <eye-off v-else :size="20" />
            </button>
          </div>
          <p
            v-if="mode === 'register' && !props.errors?.password"
            class="text-[10px] text-gray-400 mt-1.5 ml-1 italic"
          >
            Must be 8+ characters with atleast a number and a symbol (e.g., @, #, $).
          </p>
          <p
            v-if="props.errors?.password"
            class="text-red-500 text-xs mt-1 animate-pulse"
          >
            {{ props.errors.password[0] }}
          </p>
        </div>

        <div v-if="mode === 'register'">
          <label class="block text-sm font-semibold text-gray-600 mb-1"
            >Confirm Password</label
          >
          <div class="relative">
            <input
              v-model="form.password_confirmation"
              :type="showConfirmPassword ? 'text' : 'password'"
              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
              placeholder="••••••••"
            />
            <button
              @click="showConfirmPassword = !showConfirmPassword"
              type="button"
              class="absolute cursor-pointer right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors"
            >
              <Eye v-if="showConfirmPassword" :size="20" />
              <eye-off v-else :size="20" />
            </button>
          </div>
        </div>

        <button
          type="submit"
          class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95"
        >
          {{ mode === "login" ? "Login" : "Register" }}
        </button>
      </form>
      <div v-if="mode === 'login'">
        <p class="text-sm p-4 text-center">
          Don't have an account?
          <router-link to="/register"
            ><span class="text-blue-400">Sign Up</span></router-link
          >
        </p>
      </div>
      <div v-if="mode === 'register'">
        <p class="text-sm p-4 text-center">
          Already have an account?
          <router-link to="/login"
            ><span class="text-blue-400">Login</span></router-link
          >
        </p>
      </div>
    </div>
  </div>
</template>
