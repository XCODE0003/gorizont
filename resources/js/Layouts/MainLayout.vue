<script setup>
import Header from '../Components/Header.vue';
import Toast from 'primevue/toast';
import { useThemeStore } from '@/stores/themeStore';
import { onMounted } from 'vue';

const themeStore = useThemeStore();

onMounted(() => {
    themeStore.initTheme();
});
</script>

<template>
    <div class="min-h-screen bg-theme transition-all duration-300">
        <Header />
        <div class="page-wrapper px-2 sm:px-4 md:px-6">
            <slot />
        </div>
        <Toast />
    </div>
</template>

<style>
.page-wrapper > *:not([data-inertia-transition-status]) {
    animation: pageEnter 0.3s ease forwards;
}

.page-wrapper > *[data-inertia-transition-status="leaving"] {
    animation: pageLeave 0.3s ease forwards;
    position: absolute;
    width: 100%;
    top: 0;
}

@keyframes pageEnter {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translate(0);
    }
}

@keyframes pageLeave {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-10px);
    }
}

/* Адаптация под темы */
.page-wrapper {
    background-color: var(--bg-theme);
    color: var(--text-theme);
}

/* PrimeVue Toast адаптация под темы */
.p-toast .p-toast-message {
    background-color: var(--bg-theme-primary) !important;
    border: 1px solid var(--border-theme) !important;
    color: var(--text-theme) !important;
}

.p-toast .p-toast-message.p-toast-message-success {
    background-color: var(--bg-theme-primary) !important;
    border-left: 4px solid #22c55e !important;
}

.p-toast .p-toast-message.p-toast-message-error {
    background-color: var(--bg-theme-primary) !important;
    border-left: 4px solid #ef4444 !important;
}

.p-toast .p-toast-message.p-toast-message-warn {
    background-color: var(--bg-theme-primary) !important;
    border-left: 4px solid #f59e0b !important;
}

.p-toast .p-toast-message.p-toast-message-info {
    background-color: var(--bg-theme-primary) !important;
    border-left: 4px solid #3b82f6 !important;
}

.p-toast .p-toast-message .p-toast-message-content {
    color: var(--text-theme) !important;
}

.p-toast .p-toast-message .p-toast-summary {
    color: var(--text-theme) !important;
}

.p-toast .p-toast-message .p-toast-detail {
    color: var(--text-theme-secondary) !important;
}
</style>