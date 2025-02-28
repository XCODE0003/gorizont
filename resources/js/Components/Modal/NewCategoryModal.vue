<script setup>
import { ref } from 'vue';
import { usePostStore } from '../../stores/postStore';

const name = ref('');
const postStore = usePostStore();

const addCategory = () => {
    postStore.addCategory(name.value);
    name.value = '';
}
</script>

<template>
    <div class="flex flex-col gap-2">
        <div class="input-wrapper py-3 bg-transparent border px-4 border-white/20 rounded-xl">
            <input v-model="name" type="text" id="title" class="w-full text-sm " placeholder="Название тематики" />
        </div>
        <button @click="addCategory" class="btn btn-secondary">
            Добавить
        </button>
    </div>
</template>