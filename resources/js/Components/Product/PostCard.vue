<script setup>
defineProps({
    image: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    views: {
        type: Number,
        required: true
    },
    createdAt: {
        type: String,
        required: true
    },
    author: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="post-card">
        <img :src="image" alt="image" class="w-full h-44 object-cover">
        <div class="flex flex-col gap-2 py-4 px-2">
            <p class=" leading-none font-bold">{{ title }}</p>
            <p class=" leading-none text-white/60 font-normal">{{ description }}</p>
        </div>
    </div>
</template>

<style scoped>

.post-card {
    @apply flex flex-col rounded-xl border border-white/10 overflow-hidden hover:opacity-80 transition-all duration-300 cursor-pointer; 
}
</style>