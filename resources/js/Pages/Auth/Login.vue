<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import AuthTab from '../../Components/Auth/AuthTab.vue';
const authStore = useAuthStore();

const email = ref('');
const password = ref('');

const handleLogin = () => {
    authStore.login({
        email: email.value,
        password: password.value
    });
    
};
</script>

<template>
    <MainLayout>
        <div class="pt-8 mx-auto max-w-md w-full">
            <div class="bg-primary/40 rounded-2xl p-5">
                <div class="flex flex-col gap-4">
                    <h1 class="text-2xl font-bold text-center">Войдите в аккаунт</h1>

                    <AuthTab :activeTab="`login`" />

                    <div class="input-wrapper">
                        <input v-model="email" type="text" placeholder="Почта" class="w-full text-lg" />
                    </div>
                    <div class="input-wrapper">
                        <input v-model="password" type="password" placeholder="Пароль" class="w-full text-lg" />
                    </div>
                    <div v-if="authStore.error" class="text-red-500">
                        {{ authStore.error }}
                    </div>
                    <button class="btn btn-secondary py-3" :class="{ 'opacity-50': authStore.loading }"
                        :disabled="authStore.loading" @click="handleLogin">
                        {{ authStore.loading ? 'Вход...' : 'Войти' }}
                    </button>
                
                </div>
            </div>
        </div>
    </MainLayout>
</template>

