<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
import SubscribeButton from '../Components/User/SubscribeButton.vue';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import { useThemeStore } from '@/stores/themeStore';
import { Link } from '@inertiajs/vue3';

const authStore = useAuthStore();
const themeStore = useThemeStore();

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    articles: {
        type: Array,
        required: true
    },
    subscribersCount: {
        type: Number,
        default: 0
    },
    subscriptionsCount: {
        type: Number,
        default: 0
    },
    isSubscribed: {
        type: Boolean,
        default: false
    }
});

const localSubscribersCount = ref(props.subscribersCount);
const localIsSubscribed = ref(props.isSubscribed);

const handleSubscriptionUpdate = (newCount) => {
    localSubscribersCount.value = newCount;
};

const handleSubscriptionStatusUpdate = (isSubscribed) => {
    localIsSubscribed.value = isSubscribed;
};

const formatSubscribersCount = (count) => {
    if (count === 0) return 'Нет подписчиков';
    if (count === 1) return '1 подписчик';
    if (count >= 2 && count <= 4) return `${count} подписчика`;
    return `${count} подписчиков`;
};
</script>

<template>
    <MainLayout>
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex flex-col gap-4 sm:gap-6 max-w-[1200px] mx-auto">
                <div class="profile-header rounded-2xl border-theme flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 sm:px-5 sm:py-4 border gap-4 sm:gap-2">
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div class="profile-avatar bg-theme-secondary border-theme flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 text-lg sm:text-2xl border rounded-full flex-shrink-0">
                            <span class="text-theme">{{ user?.name[0] }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-theme text-lg sm:text-xl leading-none">{{ user?.name }}</p>
                            <p class="text-theme-secondary text-sm font-light leading-none">{{ formatSubscribersCount(localSubscribersCount) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <Link v-if="user?.id === authStore?.user?.id" href="/post/new" class="btn btn-primary px-3 py-3 w-full sm:w-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                :stroke="themeStore.isDarkTheme ? 'white' : '#1f2937'" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="hidden sm:inline">Создать пост</span>
                            <span class="sm:hidden">Пост</span>
                        </Link>
                        <SubscribeButton
                            v-else-if="authStore?.user"
                            :user-id="user.id"
                            :is-subscribed="localIsSubscribed"
                            :subscribers-count="localSubscribersCount"
                            @update:subscribers-count="handleSubscriptionUpdate"
                            @update:is-subscribed="handleSubscriptionStatusUpdate"
                            class="w-full sm:w-auto"
                        />
                    </div>
                </div>
                <div class="rounded-2xl border-theme flex flex-col gap-4 sm:gap-6 p-4 sm:p-6 border">
                    <div class="flex items-center justify-between">
                        <h2 class="text-theme text-lg sm:text-xl font-bold">Статьи ({{ articles.length }})</h2>
                    </div>
                    <div v-if="articles.length === 0" class="no-articles flex flex-col items-center gap-4 py-8 sm:py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="size-10 sm:size-12 text-theme-muted">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 1 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <div class="text-center px-4">
                            <p class="text-theme font-semibold text-base sm:text-lg">Пока нет статей</p>
                            <p class="text-theme-secondary text-sm">{{ user?.id === authStore?.user?.id ? 'Создайте свою первую статью' : 'Пользователь еще не создал ни одной статьи' }}</p>
                        </div>
                        <Link v-if="user?.id === authStore?.user?.id" href="/post/new" class="btn btn-primary w-full sm:w-auto justify-center">
                            Создать первую статью
                        </Link>
                    </div>
                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <PostCard
                            v-for="article in articles"
                            :key="article.id"
                            :id="article.id"
                            :image="article.image"
                            :title="article.title"
                            :description="article.content"
                            :views="article.views"
                            :created-at="article.created_at"
                            :author="article.user" />
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.profile-header {
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
}

.profile-avatar {
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}

.no-articles {
    background-color: var(--bg-theme-secondary);
    border-radius: 1rem;
    border: 1px solid var(--border-theme);
}
</style>