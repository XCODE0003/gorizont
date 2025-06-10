<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
import { usePostStore } from '../stores/postStore';
import { router } from '@inertiajs/vue3';
import { useAuthStore } from '../stores/authStore';

const props = defineProps({
    articles: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    },
    currentFilter: {
        type: String,
        default: null
    },
    currentCategory: {
        type: [String, Number],
        default: null
    }
});

const authStore = useAuthStore();

const setFilter = (filter) => {
    router.get('/', { filter }, {
        preserveState: true,
        preserveScroll: true
    });
};

const setCategory = (categoryId) => {
    router.get('/', { category: categoryId }, {
        preserveState: true,
        preserveScroll: true
    });
};

const clearFilters = () => {
    router.get('/', {}, {
        preserveState: true,
        preserveScroll: true
    });
};
</script>

<template>
    <MainLayout>
        <div class="container mx-auto flex flex-col gap-4 sm:gap-6 px-4 sm:px-6">
            <div class="flex items-center gap-2 sm:gap-3 overflow-x-auto pb-2">
                <button
                    @click="clearFilters"
                    :class="[
                        'whitespace-nowrap text-sm sm:text-base px-3 sm:px-5 py-2 rounded-lg transition-all duration-200',
                        !currentFilter && !currentCategory
                            ? 'btn btn-primary'
                            : 'btn btn-secondary'
                    ]"
                >
                    Все статьи
                </button>
                <button
                    v-if="authStore.user"
                    @click="setFilter('subscriptions')"
                    :class="[
                        'whitespace-nowrap text-sm sm:text-base px-3 sm:px-5 py-2 rounded-lg transition-all duration-200',
                        currentFilter === 'subscriptions'
                            ? 'btn btn-primary'
                            : 'btn btn-secondary'
                    ]"
                >
                    Мои подписки
                </button>
                <button
                    v-for="category in categories"
                    :key="category.id"
                    @click="setCategory(category.id)"
                    :class="[
                        'whitespace-nowrap text-sm sm:text-base px-3 sm:px-5 py-2 rounded-lg transition-all duration-200',
                        parseInt(currentCategory) === category.id
                            ? 'btn btn-primary'
                            : 'btn btn-secondary'
                    ]"
                >
                    {{ category.name }}
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                <PostCard v-for="article in articles" :key="article.id" :id="article.id" :image="article.image"
                    :title="article.title" :description="article.content" :views="article.views"
                    :createdAt="article.created_at" :author="article.author" />
            </div>
        </div>
    </MainLayout>
</template>