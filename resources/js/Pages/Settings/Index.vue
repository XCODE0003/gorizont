<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import { ref } from 'vue';
import Profile from '../../Components/Settings/Profile.vue';
import Security from '../../Components/Settings/Security.vue';
import Blacklist from '../../Components/Settings/Blacklist.vue';

const activeTab = ref('profile');
</script>

<template>
    <MainLayout>
        <div class="settings-container">
            <div class="settings-sidebar">
                <div class="sidebar-header">
                    <h2 class="sidebar-title">Настройки</h2>
                    <p class="sidebar-subtitle">Управление вашим аккаунтом</p>
                </div>

                <nav class="sidebar-nav">
                    <button class="nav-item" :class="{ active: activeTab === 'profile' }" @click="activeTab = 'profile'">
                        <div class="nav-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <span class="nav-item-text">Профиль</span>
                    </button>

                    <button class="nav-item" :class="{ active: activeTab === 'security' }" @click="activeTab = 'security'">
                        <div class="nav-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <span class="nav-item-text">Безопасность</span>
                    </button>
                </nav>
            </div>

            <div class="settings-content">
                <Profile v-if="activeTab === 'profile'" />
                <Security v-if="activeTab === 'security'" />
                <Blacklist v-if="activeTab === 'blacklist'" />
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.settings-container {
    @apply flex gap-6 max-w-5xl w-full items-start mx-auto p-6;
}

.settings-sidebar {
    @apply flex flex-col w-64 flex-shrink-0;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
    border-radius: 1rem;
    padding: 1.5rem;
}

.sidebar-header {
    @apply mb-6;
}

.sidebar-title {
    @apply text-xl font-bold mb-1;
    color: var(--text-theme);
}

.sidebar-subtitle {
    @apply text-sm;
    color: var(--text-theme-secondary);
}

.sidebar-nav {
    @apply flex flex-col gap-1;
}

.nav-item {
    @apply flex items-center gap-3 w-full p-3 rounded-lg text-left transition-all duration-200 cursor-pointer;
    color: var(--text-theme-secondary);
    background: transparent;
    border: none;
}

.nav-item:hover {
    background-color: var(--hover-theme);
    color: var(--text-theme);
    transform: translateX(2px);
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
    @apply font-medium;
}

.settings-content {
    @apply flex-1;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
    border-radius: 1rem;
    min-height: 500px;
}
</style>