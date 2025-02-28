<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useAuthStore } from '@/stores/authStore';
import AuthTab from '../../Components/Auth/AuthTab.vue';
const authStore = useAuthStore();

const email = ref('');
const name = ref('');
const password = ref('');
const password_confirmation = ref('');

const handleRegister = async () => {
    try {
        await authStore.register({
            email: email.value,
            name: name.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        });
    } catch (error) {
    }
};
</script>

<template>
    <MainLayout>
        <div class="pt-8 mx-auto max-w-md w-full">
            <div class="bg-primary/40 rounded-2xl p-5">
                <div class="flex flex-col gap-4">
                    <h1 class="text-2xl font-bold text-center">Создайте аккаунт</h1>
                    <AuthTab :activeTab="`register`" />


                    <div class="flex flex-col gap-2">
                        <div class="input-wrapper">
                            <input v-model="email" type="text" placeholder="Почта" class="w-full " />
                        </div>
                        <div class="input-wrapper">
                            <input v-model="name" type="text" placeholder="Имя" class="w-full " />
                        </div>
                        <div class="input-wrapper">
                            <input v-model="password" type="password" placeholder="Пароль" class="w-full " />
                        </div>
                        <div class="input-wrapper">
                            <input v-model="password_confirmation" type="password" placeholder="Повторите пароль"
                                class="w-full " />
                        </div>
                    </div>
                    <div class="btn btn-secondary py-3" :class="{ 'opacity-50': authStore.loading }"
                        @click="handleRegister">
                        {{ authStore.loading ? 'Регистрация...' : 'Зарегистрироваться' }}
                    </div>
                    <div v-if="authStore.error" class="text-red-500">
                        {{ authStore.error }}
                    </div>
                    <p class="text-white/40">
                        Уже есть аккаунт?
                        <Link href="/login" class="text-white">Войти</Link>
                    </p>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
