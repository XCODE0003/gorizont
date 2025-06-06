<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import { useThemeStore } from '@/stores/themeStore';
import { Link } from '@inertiajs/vue3';

const authStore = useAuthStore();
const themeStore = useThemeStore();

defineProps({
    user: {
        type: Object,
        required: true
    },
    articles: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <MainLayout>
        <div class="container mx-auto">
            <div class="flex flex-col gap-2 max-w-[1200px] mx-auto">
                <div class="profile-header py-4 px-5 flex justify-between items-center rounded-2xl border border-theme">
                    <div class="flex items-center gap-2">
                        <div class="profile-avatar w-16 h-16 text-2xl rounded-full bg-theme-secondary border border-theme flex items-center justify-center">
                            <span class="text-theme">{{ user?.name[0] }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-theme text-xl leading-none">{{ user?.name }}</p>
                            <p class="text-theme-secondary text-sm font-light leading-none">Нет подписчиков</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <Link v-if="user?.id === authStore?.user?.id" href="/post/new" class="btn btn-primary py-3 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                :stroke="themeStore.isDarkTheme ? 'white' : '#1f2937'" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Создать пост
                        </Link>
                    </div>
                </div>
                <div class="flex flex-col gap-2 p-6 rounded-2xl border border-theme">
                    <div class="flex items-center justify-between">
                        <h2 class="text-theme text-xl font-bold">Статьи ({{ articles.length }})</h2>
                    </div>
                    <div v-if="articles.length === 0" class="no-articles py-8 flex flex-col items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="size-12 text-theme-muted">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 1 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <div class="text-center">
                            <p class="text-theme font-semibold">Пока нет статей</p>
                            <p class="text-theme-secondary text-sm">{{ user?.id === authStore?.user?.id ? 'Создайте свою первую статью' : 'Пользователь еще не создал ни одной статьи' }}</p>
                        </div>
                        <Link v-if="user?.id === authStore?.user?.id" href="/post/new" class="btn btn-primary">
                            Создать первую статью
                        </Link>
                    </div>
                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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