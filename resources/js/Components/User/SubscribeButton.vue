<script setup>
import { ref } from 'vue';
import { useToast } from 'primevue/usetoast';
import { useThemeStore } from '@/stores/themeStore';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    userId: {
        type: Number,
        required: true
    },
    isSubscribed: {
        type: Boolean,
        default: false
    },
    subscribersCount: {
        type: Number,
        default: 0
    }
});

const emit = defineEmits(['update:subscribersCount', 'update:isSubscribed']);

const themeStore = useThemeStore();
const toast = useToast();
const isLoading = ref(false);
const localIsSubscribed = ref(props.isSubscribed);
const localSubscribersCount = ref(props.subscribersCount);

const toggleSubscription = async () => {
    if (isLoading.value) return;

    isLoading.value = true;

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
                user_id: props.userId
            })
        });

        const data = await response.json();

        if (data.success) {
            localIsSubscribed.value = data.is_subscribed;
            localSubscribersCount.value = data.subscribers_count;

            emit('update:subscribersCount', data.subscribers_count);
            emit('update:isSubscribed', data.is_subscribed);

            toast.add({
                severity: 'success',
                summary: 'Успешно',
                detail: data.message,
                life: 3000
            });
        } else {
            toast.add({
                severity: 'error',
                summary: 'Ошибка',
                detail: data.message,
                life: 3000
            });
        }
    } catch (error) {
        console.error('Error:', error);
        toast.add({
            severity: 'error',
            summary: 'Ошибка',
            detail: 'Произошла ошибка при обработке запроса',
            life: 3000
        });
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <button
        @click="toggleSubscription"
        :disabled="isLoading"
        class="subscribe-btn"
        :class="{
            'subscribe-btn--subscribed': localIsSubscribed,
            'subscribe-btn--loading': isLoading
        }"
    >
        <svg v-if="isLoading" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <svg v-else-if="localIsSubscribed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
        </svg>
        <span>{{ isLoading ? 'Загрузка...' : (localIsSubscribed ? 'Отписаться' : 'Подписаться') }}</span>
    </button>
</template>

<style scoped>
.subscribe-btn {
    @apply flex items-center gap-2 px-3 sm:px-4 py-2 rounded-xl font-semibold text-xs sm:text-sm transition-all duration-200 cursor-pointer justify-center;
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
}

.subscribe-btn svg {
    @apply w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0;
}

.subscribe-btn span {
    @apply hidden sm:inline;
}

.subscribe-btn:hover:not(:disabled) {
    opacity: 0.9;
    transform: translateY(-1px);
}

.subscribe-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.subscribe-btn--subscribed {
    background-color: var(--btn-secondary-bg);
    color: var(--btn-secondary-text);
}

.subscribe-btn--loading {
    background-color: #6b7280;
    color: #ffffff;
}
</style>