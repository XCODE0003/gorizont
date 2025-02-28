<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
import { usePostStore } from '../stores/postStore';

defineProps({
    articles: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <MainLayout>
        <div class="container mx-auto flex flex-col gap-4">
            <div class="flex items-center gap-2">
                <div class="btn btn-primary">
                    Мои подписки
                </div>
                <div v-for="category in categories" :key="category.id" class="btn btn-primary">
                    {{ category.name }}
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <PostCard v-for="article in articles" :key="article.id" :id="article.id" :image="article.image"
                    :title="article.title" :description="article.content" :views="article.views"
                    :createdAt="article.created_at" :author="article.author" />
            </div>
        </div>
    </MainLayout>
</template>