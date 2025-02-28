<script setup>
import { Link } from '@inertiajs/vue3';
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
    <Link :href="'/post/' + id" class="post-card">
        <img :src="'/storage/' + image" alt="image" class="w-full h-44 object-cover">
        <div class="flex flex-col gap-2 py-4 px-2">
            <p class="title-truncate font-bold">{{ title }}</p>
            <p  class="leading-none text-white/60 font-normal title-truncate ">{{ cleanDescription(description) }}</p>
        </div>
    </Link>
</template>

<style scoped>

.post-card {
    @apply flex flex-col rounded-xl border border-white/10 overflow-hidden hover:opacity-80 transition-all duration-300 cursor-pointer  ; 
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