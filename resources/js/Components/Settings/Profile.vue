<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../../stores/authStore';
const userStore = useAuthStore();
const handleImageChange = (e) => {
    const file = e.target.files[0];
    if(file) {
        console.log(file);
    }
}
</script>

<template>
    <div class="flex flex-col gap-4 p-8 w-full">
        <p class="text-2xl font-bold">Профиль</p>
        <div class="flex flex-col gap-4 w-full">
            <div class="flex items-center gap-2 w-full">
                <div class="input-wrapper-border flex-1 ">
                    <input type="text" class="input" placeholder="Имя" />
                </div>
                <div
                    class="flex h-16 w-16 flex-shrink-0 select-none overflow-hidden relative rounded-full bg-white/10 items-center justify-center">
                    <span v-if="!userStore?.user?.avatar && !file" class="text-white uppercase">{{
                        userStore?.user?.name?.charAt(0)
                        }}</span>
                    <img v-if="userStore?.user?.avatar || file" :src="file ? URL.createObjectURL(file) : userStore?.user?.avatar" alt="avatar" class="w-full h-full object-cover rounded-full" />
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
            <div class="flex flex-col gap-2">

            </div>
        </div>

    </div>
</template>
