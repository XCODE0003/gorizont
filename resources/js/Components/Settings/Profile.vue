<script setup>
import { ref, computed, watch } from 'vue';
import { useAuthStore } from '../../stores/authStore';
import { onMounted } from 'vue';

const userStore = useAuthStore();
const file = ref(null);
const fileUrl = ref(null);

const errors = ref({});
const loading = ref(false);

const handleImageChange = (e) => {
    const image = e.target.files[0];
    if(image) {
        file.value = image;
        fileUrl.value = URL.createObjectURL(image);
        avatar.value = image;
    }
}

const name = ref('');
const avatar = ref(null);

watch(() => userStore.user, (newUser) => {
    if (newUser) {
        name.value = newUser.name || '';
        avatar.value = newUser.avatar || null;
    }
}, { immediate: true, deep: true });

onMounted(() => {
    if (userStore.user) {
        name.value = userStore.user.name || '';
        avatar.value = userStore.user.avatar || null;
    }
});

const handleSubmit = async () => {
    errors.value = {};
    loading.value = true;

    try {
        const formData = new FormData();

        // Отправляем имя только если оно не пустое
        if (name.value?.trim()) {
            formData.append('name', name.value.trim());
        }

        // Отправляем файл только если он был выбран
        if (file?.value instanceof File) {
            formData.append('avatar', file.value);
        }

        await userStore.updateUser(formData);
    } catch (error) {
        if (error.response?.data?.errors) {
            errors.value = error.response.data.errors;
        } else if (error.response?.data?.message) {
            errors.value = { general: [error.response.data.message] };
        }
    } finally {
        loading.value = false;
    }
}
</script>

<template>
    <div class="flex flex-col gap-4 p-8 w-full">
        <p class="text-2xl font-bold">Профиль</p>
        <div class="flex flex-col gap-4 w-full">
            <div v-if="errors.general" class="text-red-500 text-sm">
                {{ errors.general[0] }}
            </div>
            <div class="flex items-center gap-2 w-full">
                <div class="flex flex-col w-full">
                    <div class="input-wrapper-border flex-1">
                        <input
                            type="text"
                            class="input"
                            :class="{ 'border-red-500': errors.name }"
                            placeholder="Имя"
                            v-model="name"
                        />
                    </div>
                    <span v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name[0] }}</span>
                </div>
                <div
                    class="flex h-16 w-16 flex-shrink-0 select-none overflow-hidden relative rounded-full bg-white/10 items-center justify-center">
                    <span v-if="avatar === null && !fileUrl" class="text-white uppercase">{{
                        name?.charAt(0)
                        }}</span>
                    <img v-else-if="fileUrl" :src="fileUrl" alt="avatar" class="w-full h-full object-cover rounded-full" />
                    <img v-else-if="avatar" :src="avatar" alt="avatar" class="w-full h-full object-cover rounded-full" />
                    <span v-else class="text-white uppercase">{{ name?.charAt(0) }}</span>
                    <label class="w-full h-full absolute top-0 left-0 flex items-center justify-center cursor-pointer hover:opacity-80 transition-all duration-300 bg-black/50 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        <input type="file" class="hidden" accept="image/*" @change="handleImageChange"/>
                    </label>
                </div>
            </div>
            <div v-if="errors.avatar" class="text-red-500 text-sm">{{ errors.avatar[0] }}</div>
            <button
                @click="handleSubmit"
                class="btn btn-secondary"
                :disabled="loading"
            >
                {{ loading ? 'Сохранение...' : 'Сохранить' }}
            </button>
        </div>
    </div>
</template>
