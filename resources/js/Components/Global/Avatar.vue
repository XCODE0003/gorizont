<script setup>
import { useAuthStore } from '@/stores/authStore';
import { useThemeStore } from '@/stores/themeStore';

const authStore = useAuthStore();
const themeStore = useThemeStore();

// Пример стилей для переноса текста, которые можно применить к компоненту с контентом статьи
const textWrapStyles = {
  'white-space': 'pre-wrap',
  'word-wrap': 'break-word',
  'overflow-wrap': 'break-word'
};
</script>

<template>
    <div v-if="authStore?.user?.avatar === null"
        class="flex h-10 w-10 select-none rounded-full items-center justify-center transition-all duration-300"
        :class="themeStore.isDarkTheme ? 'bg-white/10' : 'bg-gray-200'">
        <span class="text-theme font-medium">{{
            authStore?.user?.name?.charAt(0)
        }}</span>
    </div>
    <div v-else>
        <img :src="authStore?.user?.avatar" alt="avatar" class="w-10 h-10 object-cover rounded-full border-2 transition-all duration-300"
             :class="themeStore.isDarkTheme ? 'border-white/20' : 'border-gray-200'" />
    </div>
</template>