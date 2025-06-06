<script setup>
import { useAuthStore } from '@/stores/authStore';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div v-if="user?.avatar === null"
        class="avatar-placeholder bg-theme-secondary flex items-center justify-center flex-shrink-0 w-6 h-6 text-xs rounded-full select-none">
        <span class="text-theme">{{
            user?.name?.charAt(0)
        }}</span>
    </div>
    <div v-else>
        <img :src="user?.avatar" alt="avatar" class="flex-shrink-0 object-cover w-6 h-6 rounded-full" />
    </div>
</template>

<style scoped>
.avatar-placeholder {
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}
</style>