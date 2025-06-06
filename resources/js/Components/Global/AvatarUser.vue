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
        class="bg-black/0 dark:bg-white/10 flex items-center justify-center flex-shrink-0 w-6 h-6 text-xs rounded-full select-none">
        <span class="text-white">{{
            user?.name?.charAt(0)
        }}</span>
    </div>
    <div v-else>
        <img :src="user?.avatar" alt="avatar" class="flex-shrink-0 object-cover w-6 h-6 rounded-full" />
    </div>
</template>