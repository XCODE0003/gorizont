<script setup>
import { ref, computed, watch } from 'vue';
import { useAuthStore } from '../../stores/authStore';
import { onMounted } from 'vue';

const userStore = useAuthStore();
const old_password = ref('');
const new_password = ref('');
const confirm_password = ref('');

const handleSubmit = () => {
    userStore.updatePassword({ current_password: old_password.value, password: new_password.value, password_confirmation: confirm_password.value });
}
</script>

<template>
    <div class="flex flex-col gap-4 p-8 w-full">
        <p class="text-2xl font-bold">Безопасность</p>
        <div class="flex flex-col gap-4 w-full">
            <div class="input-wrapper-border flex-1 ">
                <input v-model="old_password" type="password" class="input" placeholder="Старый пароль" />
            </div>
            <div class="input-wrapper-border flex-1 ">
                <input v-model="new_password" type="password" class="input" placeholder="Новый пароль" />
            </div>
            <div class="input-wrapper-border flex-1 ">
                <input v-model="confirm_password" type="password" class="input" placeholder="Подтвердить пароль" />
            </div>

            <button @click="handleSubmit" class="btn btn-secondary ">
                Сохранить
            </button>
        </div>
    </div>
</template>
