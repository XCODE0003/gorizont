<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    activeTab: {
        type: String,
        default: 'login'
    }
});
</script>

<template>
    <div class="auth-tabs-wrapper">
        <div class="auth-tabs-container">
            <Link href="/login" :class="{ 'active': activeTab === 'login' }" class="auth-tab">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
                Вход
            </Link>
            <Link href="/register" :class="{ 'active': activeTab === 'register' }" class="auth-tab">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
                Регистрация
            </Link>
        </div>
    </div>
</template>

<style scoped>
.auth-tabs-wrapper {
    @apply w-full;
}

.auth-tabs-container {
    @apply p-1 rounded-xl w-full grid grid-cols-2 gap-1;
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}

.auth-tab {
    @apply flex items-center justify-center gap-2 py-3 px-4 rounded-lg text-sm font-semibold transition-all duration-200 cursor-pointer;
    color: var(--text-theme-secondary);
}

.auth-tab:hover {
    color: var(--text-theme);
    background-color: var(--hover-theme);
}

.auth-tab.active {
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.auth-tab.active:hover {
    background-color: var(--btn-primary-bg);
    opacity: 0.9;
}
</style>
