<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const currentRoute = page.url;
</script>

<template>
    <div class="settings-container">
        <div class="settings-sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Настройки</h2>
            </div>

            <nav class="sidebar-nav">
                <Link href="/settings" class="nav-item" :class="{ active: currentRoute === '/settings' }">
                    <div class="nav-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <span class="nav-item-text">Профиль</span>
                </Link>

                <Link href="/settings/subscriptions" class="nav-item" :class="{ active: currentRoute === '/settings/subscriptions' }">
                    <div class="nav-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </div>
                    <span class="nav-item-text">Мои подписки</span>
                </Link>
            </nav>
        </div>

        <div class="settings-content">
            <slot />
        </div>
    </div>
</template>

<style scoped>
.settings-container {
    @apply flex flex-col lg:flex-row gap-4 lg:gap-6 max-w-5xl w-full items-start mx-auto p-4 lg:p-6;
}

.settings-sidebar {
    @apply flex flex-col w-full lg:w-64 flex-shrink-0;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
    border-radius: 1rem;
    padding: 1rem;
}

.sidebar-header {
    @apply mb-4 lg:mb-6;
}

.sidebar-title {
    @apply text-lg lg:text-xl font-bold mb-1;
    color: var(--text-theme);
}

.sidebar-nav {
    @apply flex flex-row lg:flex-col gap-1 overflow-x-auto lg:overflow-x-visible;
}

.nav-item {
    @apply flex items-center gap-3 w-full lg:w-auto min-w-max lg:min-w-0 p-3 rounded-lg text-left transition-all duration-200 cursor-pointer;
    color: var(--text-theme-secondary);
    background: transparent;
    border: none;
    text-decoration: none;
}

.nav-item:hover {
    background-color: var(--hover-theme);
    color: var(--text-theme);
    transform: translateX(0);
}

@media (min-width: 1024px) {
    .nav-item:hover {
        transform: translateX(2px);
    }
}

.nav-item.active {
    background-color: #3b82f6;
    color: white;
}

.nav-item.active:hover {
    background-color: #2563eb;
}

.nav-item-icon {
    @apply flex-shrink-0;
}

.nav-item-text {
    @apply font-medium text-sm lg:text-base;
}

.settings-content {
    @apply flex-1 p-4 lg:p-6;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
    border-radius: 1rem;
    min-height: 500px;
}
</style>