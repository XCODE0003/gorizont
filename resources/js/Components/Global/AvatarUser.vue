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
        class="flex h-10 w-10 select-none rounded-full bg-white/10 flex-shrink-0 items-center justify-center">
        <span class="text-white">{{
            user?.name?.charAt(0)
        }}</span>
    </div>
    <div v-else>
        <img :src="user?.avatar" alt="avatar" class="w-6 h-6 flex-shrink-0 object-cover rounded-full" />
    </div>
</template>