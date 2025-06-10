<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import { useThemeStore } from '@/stores/themeStore';
import AuthTab from '../../Components/Auth/AuthTab.vue';

const authStore = useAuthStore();
const themeStore = useThemeStore();

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
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="auth-logo">
                        <svg width="48" height="48" viewBox="0 0 72 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32.0028 24.6869L30.1557 3.76687C30.1557 1.69881 32.5742 0 35.6163 0C38.6637 0 41.0861 1.69881 41.0861 3.76687L39.2345 24.6869C39.0264 25.9469 37.4873 26.9194 35.6142 26.9194C33.7479 26.9194 32.207 25.9469 32.0028 24.6869Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                            <path d="M24.3063 33.4495C25.2422 31.8265 25.1702 30.0113 24.181 29.2029L6.98515 17.1429C5.19918 16.1083 2.51649 17.3537 0.994998 19.9916C-0.531271 22.6265 -0.260524 25.571 1.52515 26.6038L20.5631 35.4692C21.7553 35.9125 23.372 35.0695 24.3063 33.4495Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                            <path d="M46.9299 33.4495C47.8655 35.0704 49.4792 35.9125 50.6708 35.4692L69.712 26.6038C71.5052 25.571 71.7625 22.6265 70.247 19.9916C68.7183 17.3537 66.0329 16.1083 64.2499 17.1429L47.0541 29.2029C46.0705 30.0113 45.9944 31.8289 46.9299 33.4495Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                            <path d="M32.0028 55.2766L30.1557 76.1961C30.1557 78.2671 32.5742 79.962 35.6163 79.962C38.6637 79.962 41.0861 78.2671 41.0861 76.1961L39.2345 55.2766C39.0264 54.0178 37.4873 53.0501 35.6142 53.0501C33.7479 53.0501 32.207 54.0178 32.0028 55.2766Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                            <path d="M47.0541 50.7719L64.2499 62.8227C66.0329 63.8543 68.7183 62.6045 70.2469 59.9752C71.7625 57.3379 71.5051 54.3916 69.712 53.3543L50.6708 44.4994C49.4792 44.0505 47.8675 44.8922 46.9299 46.5149C45.9944 48.134 46.0705 49.954 47.0541 50.7719Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                            <path d="M20.5631 44.4997L1.52515 53.3546C-0.260524 54.3919 -0.531271 57.3382 0.994998 59.9755C2.51649 62.6045 5.19918 63.8546 6.98515 62.823L24.181 50.7722C25.1702 49.954 25.2419 48.1373 24.3069 46.5152C23.3714 44.8922 21.7553 44.0507 20.5631 44.4997Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                        </svg>
                    </div>
                    <h1 class="auth-title">Добро пожаловать</h1>
                    <p class="auth-subtitle">Войдите в свой аккаунт Gorizont</p>
                </div>

                <AuthTab :activeTab="`login`" />

                <form @submit.prevent="handleLogin" class="auth-form">
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            Электронная почта
                        </label>
                        <div class="auth-input-wrapper">
                            <input
                                v-model="email"
                                type="email"
                                id="email"
                                placeholder="your@email.com"
                                class="auth-input"
                                required
                            />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            Пароль
                        </label>
                        <div class="auth-input-wrapper">
                            <input
                                v-model="password"
                                type="password"
                                id="password"
                                placeholder="Введите пароль"
                                class="auth-input"
                                required
                            />
                        </div>
                    </div>

                    <div v-if="authStore.error" class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        {{ authStore.error }}
                    </div>

                    <button
                        type="submit"
                        class="auth-submit-btn"
                        :class="{ 'loading': authStore.loading }"
                        :disabled="authStore.loading"
                    >
                        <svg v-if="authStore.loading" class="animate-spin w-5 h-5 mr-3 -ml-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        {{ authStore.loading ? 'Вход в систему...' : 'Войти' }}
                    </button>
                </form>

                <div class="auth-footer">
                    <p class="footer-text">
                        Нет аккаунта?
                        <Link href="/register" class="footer-link">Зарегистрироваться</Link>
                    </p>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.auth-container {
    @apply flex items-center justify-center min-h-screen w-full p-4;
    background-color: var(--bg-theme);
    margin-top: -80px;
    padding-top: 80px;
}
.auth-card {
    @apply w-full max-w-sm sm:max-w-md lg:max-w-xl space-y-4 sm:space-y-6 p-6 sm:p-8 rounded-2xl shadow-lg mx-auto;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
}

.auth-header {
    @apply text-center space-y-4;
}

.auth-logo {
    @apply flex justify-center;
}

.auth-title {
    @apply text-3xl font-bold;
    color: var(--text-theme);
}

.auth-subtitle {
    color: var(--text-theme-secondary);
}

.auth-form {
    @apply space-y-4;
}

.form-group {
    @apply space-y-3;
}

.form-label {
    @apply flex items-center gap-2 text-sm font-medium;
    color: var(--text-theme);
}

.auth-input-wrapper {
    @apply relative;
}

.auth-input {
    @apply w-full px-4 py-4 rounded-xl border-2 transition-all duration-200 font-medium text-base;
    background-color: var(--bg-theme-secondary);
    border-color: var(--border-theme);
    color: var(--text-theme);
}

.auth-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.auth-input::placeholder {
    color: var(--text-theme-muted);
}

.error-message {
    @apply flex items-center gap-2 px-4 py-3 rounded-lg text-sm font-medium;
    background-color: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.auth-submit-btn {
    @apply w-full flex items-center justify-center gap-2 px-4 py-4 rounded-xl font-semibold transition-all duration-200;
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
}

.auth-submit-btn:hover:not(:disabled) {
    opacity: 0.9;
    transform: translateY(-1px);
    box-shadow: 0 10px 25px -5px rgba(41, 41, 43, 0.3);
}

.auth-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.auth-submit-btn.loading {
    background-color: #6b7280;
}

.auth-footer {
    @apply pt-6 border-t;
    border-color: var(--border-theme);
}

.footer-text {
    @apply text-center text-base;
    color: var(--text-theme-secondary);
}

.footer-link {
    @apply font-medium transition-colors duration-200;
    color: #3b82f6;
}

.footer-link:hover {
    color: #2563eb;
}

/* Светлая тема - специальные стили */
.light .error-message {
    background-color: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.light .auth-submit-btn:hover:not(:disabled) {
    box-shadow: 0 10px 25px -5px rgba(41, 41, 43, 0.2);
}

/* Темная тема - специальные стили */
.dark .error-message {
    background-color: #1f1f1f;
    color: #f87171;
    border-color: #374151;
}

.dark .auth-submit-btn:hover:not(:disabled) {
    box-shadow: 0 10px 25px -5px rgba(41, 41, 43, 0.4);
}
</style>
