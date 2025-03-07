<script setup>
import Dialog from 'primevue/dialog';
import MainLayout from '../../Layouts/MainLayout.vue';
import PostCard from '../../Components/Product/PostCard.vue';
import { ref } from "vue";
import { onMounted } from 'vue';
import { useAuthStore } from '../../stores/authStore';
import { Link } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import axios from 'axios';
import AvatarUser from '../../Components/Global/AvatarUser.vue';

const toast = useToast();

const userStore = useAuthStore();

const props = defineProps({
    article: {
        type: Object,
        required: true
    },
    comments: {
        type: Array,
        required: true
    },
    isLiked: {
        type: Boolean,
        required: true
    }
});

const isLiked = ref(props.isLiked);


function like() {
    axios.post(`/post/${props.article.id}/like`)
        .then(response => {
            isLiked.value = !isLiked.value;
            props.article.likesCount = response.data.article.likesCount;
        })
        .catch(error => {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Статья не найдена' });
        });
}
</script>

<template>
    <MainLayout>
        <div class="max-w-2xl w-full mx-auto pb-20 ">
            <div class="flex  flex-col gap-4">
                <img :src="'/storage/' + article.image" alt="image" class="w-full h-64 object-cover rounded-lg">
                <h1 class="text-2xl font-bold text-center">{{ article.title }}</h1>
                <div class="text-white/60 font-normal text-wrapper" v-html="article.content"></div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button @click="like" v-if="userStore.user && userStore.user.id !== article.user_id"
                            :class="{ 'text-white': isLiked, 'text-white/30': !isLiked }"
                            class=" btn hover:bg-white/10  hover:text-white transition-all duration-300">
                            <svg viewBox="0 -0.5 21 21" version="1.1" class="size-5" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-219.000000, -760.000000)"
                                            fill="currentColor">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M163,610.021159 L163,618.021159 C163,619.126159 163.93975,620.000159 165.1,620.000159 L167.199999,620.000159 L167.199999,608.000159 L165.1,608.000159 C163.93975,608.000159 163,608.916159 163,610.021159 M183.925446,611.355159 L182.100546,617.890159 C181.800246,619.131159 180.639996,620.000159 179.302297,620.000159 L169.299999,620.000159 L169.299999,608.021159 L171.104948,601.826159 C171.318098,600.509159 172.754498,599.625159 174.209798,600.157159 C175.080247,600.476159 175.599997,601.339159 175.599997,602.228159 L175.599997,607.021159 C175.599997,607.573159 176.070397,608.000159 176.649997,608.000159 L181.127196,608.000159 C182.974146,608.000159 184.340196,609.642159 183.925446,611.355159"
                                                    id="like-[#1386]"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            {{ article.likesCount }}

                        </button>
                    </div>
                    <Link :href="`/profile/${article.user.id}`"
                        class="flex items-center hover:bg-white/10 transition-all duration-300 bg-white/5 rounded-xl px-3 py-1 gap-3">
                    <AvatarUser :user="article.user" />
                    <p class="text-white/60 text-sm font-normal">{{ article.user.name }}</p>
                    </Link>
                </div>
                <!-- <div class="flex flex-col gap-4">
                    <div class="py-4 px-5 bg-white/5 flex items-center gap-3 rounded-xl">
                        <input type="text"
                            class="w-full bg-transparent outline-none text-white/60 placeholder:text-white/40"
                            placeholder="Напишите комментарий...">
                        <button class="btn btn-secondary py-1.5">Отправить</button>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div v-for="i in 5" class="py-4 px-5 bg-white/5 relative pt-8 flex items-start gap-2 rounded-xl">
                            <div class="p-1 bg-body absolute -top-3.5 left-4.5 rounded-lg">
                                <div class="bg-white/10 rounded-lg px-2 py-1 flex items-center gap-2 ">
                                    <AvatarUser :user="article.user" />
                                    <p class="text-white/60 text-sm font-normal">{{ article.user.name }}</p>
                                </div>
                            </div>
                            <div class="text-white/60 text-sm font-normal">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

        </div>
        <div class="fixed bottom-6 right-6">
            <Link :href="`/post/${article.id}/edit`" v-if="article?.user_id === userStore?.user?.id"
                class="h-12 w-12 btn btn-primary rounded-full flex items-center justify-center shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="white" class="size-5 flex-shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </div>
            </Link>
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