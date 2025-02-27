<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import { Link } from '@inertiajs/vue3';
const authStore = useAuthStore();

</script>

<template>
    <MainLayout>
        <div class="container mx-auto">
            <div class="flex flex-col gap-2 max-w-[1200px] mx-auto">
                <div class="py-4 px-5 flex justify-between items-center rounded-2xl border border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-16 h-16 text-2xl rounded-full bg-white/10 flex items-center justify-center">
                            {{ authStore?.user?.name[0] }}
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-white text-xl leading-none">{{ authStore?.user?.name }}</p>
                            <p class="text-white/60 text-sm font-light leading-none">Нет подписчиков</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <Link href="/post/new" class="btn btn-primary py-3 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>


                        </Link>
                    </div>
                </div>
                <div class="py-12 px-5 rounded-2xl bg-primary/50 border border-white/10 flex flex-col gap-5">
                    <img src="/assets/images/project/empty-saved_dark.png" alt="" class="h-52 mx-auto object-cover rounded-2xl">
                    <div class="flex flex-col gap-2 w-full justify-center items-center ">
                        <p class="text-white text-xl leading-none">Пока тут ничего нет</p>
                        <p class="text-white/60  font-light leading-none">Когда-нибудь здесь появятся посты</p>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>