<script setup>
import { Link } from '@inertiajs/vue3';
import { useThemeStore } from '@/stores/themeStore';

const themeStore = useThemeStore();

defineProps({
    id: {
        type: Number,
        required: true
    },
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

function cleanDescription(description) {
  if (!description) return '';

  const textarea = document.createElement('textarea');
  textarea.innerHTML = description;
  let decodedText = textarea.value;

  decodedText = decodedText.replace(/<[^>]*>/g, '');

  decodedText = decodedText.replace(/&nbsp;/g, ' ');
  decodedText = decodedText.replace(/\u00A0/g, ' ');

  decodedText = decodedText.replace(/&[a-zA-Z0-9#]+;/g, '');

  decodedText = decodedText.replace(/\s+/g, ' ').trim();

  return decodedText;
}
</script>

<template>
    <Link :href="'/post/view/' + id" class="post-card">
        <img :src="'/storage/' + image" alt="image" class="h-44 object-cover w-full">
        <div class="flex flex-col gap-2 px-2 py-4">
            <p class="title-truncate font-bold text-theme">{{ title }}</p>
            <p class="text-theme-secondary title-truncate font-normal leading-none">{{ cleanDescription(description) }}</p>
        </div>
    </Link>
</template>

<style scoped>
.post-card {
    @apply flex flex-col rounded-xl overflow-hidden transition-all duration-300 cursor-pointer;
    background-color: var(--bg-theme-primary);
    border: 1px solid var(--border-theme);
}

.post-card:hover {
    opacity: 0.8;
    background-color: var(--hover-theme);
}

.title-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
    display: block;
    font-weight: bold;
    line-height: 1;
}
</style>