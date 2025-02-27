<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    activeTab: {
        type: String,
        default: 'login'
    }
});
</script>
<template>
    <div class="px-12">
        <div class="p-1 border w-full border-white/10  rounded-xl">
            <div class="flex items-center gap-2">
                <Link href="/login" :class="{ 'active': activeTab === 'login' }" class="tab_item">
                    Вход
                </Link>
                <Link href="/register" :class="{ 'active': activeTab === 'register' }" class="tab_item">
                    Регистрация
                </Link>
            </div>

        </div>
    </div>
</template>
