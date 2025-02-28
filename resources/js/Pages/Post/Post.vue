<script setup>
import Dialog from 'primevue/dialog';
import MainLayout from '../../Layouts/MainLayout.vue';
import PostCard from '../../Components/Product/PostCard.vue';
import { ref } from "vue";
import { onMounted } from 'vue';
import { useAuthStore } from '../../stores/authStore';
import { Link } from '@inertiajs/vue3';
const userStore = useAuthStore();

defineProps({
    article: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <MainLayout>
        <div class="max-w-xl mx-auto pb-20 ">
            <div class="flex  flex-col gap-4">
                <img :src="'/storage/' + article.image" alt="image" class="w-full h-44 object-cover rounded-lg">
                <h1 class="text-2xl font-bold text-center">{{ article.title }}</h1>
                <div class="text-white/60 font-normal text-wrapper" v-html="article.content"></div>

            </div>

        </div>
        <div class="fixed bottom-6 right-6">
            <div v-if="article?.user_id === userStore?.user?.id" class="h-12 w-12 btn btn-primary rounded-full flex items-center justify-center shadow-lg">
                <Link :href="`/post/${article.id}/edit`">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </Link>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
:deep(.p-editor-container) {
    border-radius: 1rem !important;
    overflow: hidden;
}

:deep(.p-editor-toolbar) {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

:deep(.p-editor-content) {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

:deep(.ql-container) {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

:deep(.ql-editor) {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}
</style>