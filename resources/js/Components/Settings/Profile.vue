<script setup>
import { ref, computed, watch } from 'vue';
import { useAuthStore } from '../../stores/authStore';
import { useThemeStore } from '../../stores/themeStore';
import { onMounted } from 'vue';

const userStore = useAuthStore();
const themeStore = useThemeStore();
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

        if (name.value?.trim()) {
            formData.append('name', name.value.trim());
        }

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
    <div class="profile-settings-container flex flex-col gap-6">
        <div class="profile-header">
            <h2 class="text-theme mb-4 text-xl font-bold">Настройки профиля</h2>
            <p class="text-theme-secondary">Обновите информацию профиля и аватар</p>
        </div>

        <form @submit.prevent="handleSubmit" class="profile-form flex flex-col gap-6">
            <!-- Аватар -->
            <div class="avatar-section flex flex-col gap-4">
                <label class="text-theme font-semibold">Аватар</label>
                <div class="avatar-wrapper flex items-center gap-4">
                    <div class="avatar-container bg-theme-secondary border-theme relative flex items-center justify-center flex-shrink-0 w-16 h-16 overflow-hidden border rounded-full select-none">
                        <span v-if="avatar === null && !fileUrl" class="text-theme uppercase">{{
                            name?.charAt(0)
                        }}</span>
                        <img v-else-if="fileUrl" :src="fileUrl" alt="avatar" class="object-cover w-full h-full rounded-full" />
                        <img v-else-if="avatar" :src="avatar" alt="avatar" class="object-cover w-full h-full rounded-full" />
                        <span v-else class="text-theme uppercase">{{ name?.charAt(0) }}</span>
                        <label class="avatar-overlay hover:opacity-80 bg-black/50 absolute top-0 left-0 flex items-center justify-center w-full h-full transition-all duration-300 rounded-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            <input type="file" class="hidden" accept="image/*" @change="handleImageChange"/>
                        </label>
                    </div>
                    <div class="avatar-info flex flex-col gap-1">
                        <p class="text-theme text-sm font-medium">Нажмите на аватар для изменения</p>
                        <p class="text-theme-muted text-xs">JPG, PNG. Максимум 2MB</p>
                    </div>
                </div>
                <div v-if="errors.avatar" class="error-message text-sm text-red-500">
                    {{ errors.avatar[0] }}
                </div>
            </div>

            <!-- Имя -->
            <div class="name-section flex flex-col gap-2">
                <label for="name" class="text-theme font-semibold">Имя</label>
                <div class="input-wrapper-border">
                    <input
                        id="name"
                        type="text"
                        v-model="name"
                        placeholder="Введите ваше имя"
                        class="text-theme w-full bg-transparent outline-none"
                    />
                </div>
                <div v-if="errors.name" class="error-message text-sm text-red-500">
                    {{ errors.name[0] }}
                </div>
            </div>

            <!-- Кнопка сохранения -->
            <div class="submit-section">
                <button
                    type="submit"
                    :disabled="loading"
                    class="btn btn-primary"
                    :class="{ 'opacity-50 cursor-not-allowed': loading }"
                >
                    {{ loading ? 'Сохранение...' : 'Сохранить изменения' }}
                </button>
            </div>

            <!-- Общие ошибки -->
            <div v-if="errors.general" class="error-message text-sm text-red-500">
                {{ errors.general[0] }}
            </div>
        </form>
    </div>
</template>

<style scoped>
.profile-settings-container {
    padding: 1.5rem;
    border-radius: 1rem;
}

.avatar-container {
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
}

.avatar-overlay:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
}

.input-wrapper-border {
    background-color: var(--bg-theme-secondary);
    border: 1px solid var(--border-theme);
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.input-wrapper-border:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>
