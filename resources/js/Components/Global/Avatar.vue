<script setup>
import { useAuthStore } from '@/stores/authStore';

const authStore = useAuthStore();

// Пример стилей для переноса текста, которые можно применить к компоненту с контентом статьи
const textWrapStyles = {
  'white-space': 'pre-wrap',
  'word-wrap': 'break-word',
  'overflow-wrap': 'break-word'
};
</script>

<template>

    <div v-if="authStore?.user?.avatar === null"
        class="flex h-10 w-10 select-none rounded-full bg-white/10 items-center justify-center">
        <span class="text-white">{{
            authStore?.user?.name?.charAt(0)
        }}</span>
    </div>
    <div v-else>
        <img :src="authStore?.user?.avatar" alt="avatar" class="w-10 h-10 object-cover rounded-full" />
    </div>
</template>