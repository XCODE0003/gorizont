<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import SettingsLayout from '../../Layouts/SettingsLayout.vue';
import { Link } from '@inertiajs/vue3';
import { useThemeStore } from '@/stores/themeStore';
import { useToast } from 'primevue/usetoast';
import { ref } from 'vue';

const themeStore = useThemeStore();
const toast = useToast();

const props = defineProps({
    subscriptions: {
        type: Array,
        default: () => []
    },
    subscribers: {
        type: Array,
        default: () => []
    },
    subscriptionsCount: {
        type: Number,
        default: 0
    },
    subscribersCount: {
        type: Number,
        default: 0
    }
});

const activeTab = ref('subscriptions');

const unsubscribe = async (userId) => {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/subscribe/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                user_id: userId
            })
        });

        const data = await response.json();

        if (data.success) {
            location.reload();
            toast.add({
                severity: 'success',
                summary: 'Успешно',
                detail: data.message,
                life: 3000
            });
        }
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Ошибка',
            detail: 'Произошла ошибка при отписке',
            life: 3000
        });
    }
};
</script>

<template>
    <MainLayout>
        <SettingsLayout>
            <div class="settings-content">
                <div class="settings-header">
                    <h1 class="settings-title">Мои подписки</h1>
                    <p class="settings-subtitle">Управляйте своими подписками и подписчиками</p>
                </div>

                <div class="subscriptions-tabs">
                    <button
                        @click="activeTab = 'subscriptions'"
                        :class="{ 'tab-active': activeTab === 'subscriptions' }"
                        class="subscription-tab"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Мои подписки ({{ subscriptionsCount }})
                    </button>
                    <button
                        @click="activeTab = 'subscribers'"
                        :class="{ 'tab-active': activeTab === 'subscribers' }"
                        class="subscription-tab"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Мои подписчики ({{ subscribersCount }})
                    </button>
                </div>

                <!-- Подписки -->
                <div v-if="activeTab === 'subscriptions'" class="subscriptions-content">
                    <div v-if="subscriptions.length === 0" class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-theme-muted">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        <div class="text-center">
                            <p class="text-theme font-semibold">У вас нет подписок</p>
                            <p class="text-theme-secondary text-sm">Найдите интересных авторов и подпишитесь на них</p>
                        </div>
                    </div>
                    <div v-else class="users-grid">
                        <div v-for="subscription in subscriptions" :key="subscription.id" class="user-card">
                            <Link :href="`/profile/${subscription.user.id}`" class="user-info">
                                <div class="user-avatar">
                                    <span class="text-theme">{{ subscription.user.name[0] }}</span>
                                </div>
                                <div class="user-details">
                                    <p class="user-name">{{ subscription.user.name }}</p>
                                    <p class="user-date">Подписка с {{ subscription.created_at }}</p>
                                </div>
                            </Link>
                            <button @click="unsubscribe(subscription.user.id)" class="unsubscribe-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                Отписаться
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Подписчики -->
                <div v-if="activeTab === 'subscribers'" class="subscriptions-content">
                    <div v-if="subscribers.length === 0" class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-theme-muted">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        <div class="text-center">
                            <p class="text-theme font-semibold">У вас нет подписчиков</p>
                            <p class="text-theme-secondary text-sm">Создавайте интересный контент, чтобы привлечь подписчиков</p>
                        </div>
                    </div>
                    <div v-else class="users-grid">
                        <div v-for="subscriber in subscribers" :key="subscriber.id" class="user-card">
                            <Link :href="`/profile/${subscriber.user.id}`" class="user-info">
                                <div class="user-avatar">
                                    <span class="text-theme">{{ subscriber.user.name[0] }}</span>
                                </div>
                                <div class="user-details">
                                    <p class="user-name">{{ subscriber.user.name }}</p>
                                    <p class="user-date">Подписался {{ subscriber.created_at }}</p>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </MainLayout>
</template>

<style scoped>
.settings-content {
    @apply space-y-6;
}

.settings-header {
    @apply space-y-2;
}

.settings-title {
    @apply text-2xl font-bold;
    color: var(--text-theme);
}

.settings-subtitle {
    color: var(--text-theme-secondary);
}

.subscriptions-tabs {
    @apply flex gap-1 sm:gap-2 p-1 rounded-xl;
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}

.subscription-tab {
    @apply flex items-center gap-1 sm:gap-2 py-2 sm:py-3 px-2 sm:px-4 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer flex-1 justify-center;
    color: var(--text-theme-secondary);
}

.subscription-tab svg {
    @apply w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0;
}

.subscription-tab span {
    @apply truncate;
}

.subscription-tab:hover {
    color: var(--text-theme);
    background-color: var(--hover-theme);
}

.subscription-tab.tab-active {
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.subscriptions-content {
    @apply mt-6;
}

.empty-state {
    @apply flex flex-col items-center gap-4 py-12 px-6 rounded-xl;
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}

.users-grid {
    @apply grid grid-cols-1 gap-3 sm:gap-4;
}

.user-card {
    @apply flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 sm:p-4 rounded-xl transition-all duration-200 gap-3 sm:gap-0;
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}

.user-card:hover {
    background-color: var(--hover-theme);
}

.user-info {
    @apply flex items-center gap-3 flex-1 w-full sm:w-auto;
}

.user-avatar {
    @apply w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg font-semibold flex-shrink-0;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
}

.user-details {
    @apply space-y-1 min-w-0 flex-1;
}

.user-name {
    @apply font-semibold text-sm sm:text-base truncate;
    color: var(--text-theme);
}

.user-date {
    @apply text-xs sm:text-sm;
    color: var(--text-theme-secondary);
}

.unsubscribe-btn {
    @apply flex items-center gap-2 px-3 py-2 rounded-lg text-xs sm:text-sm font-medium transition-all duration-200 w-full sm:w-auto justify-center;
    color: #ef4444;
    background-color: transparent;
    border: 1px solid #ef4444;
}

.unsubscribe-btn:hover {
    background-color: #ef4444;
    color: white;
}
</style>