<script setup>
import { Link } from "@inertiajs/vue3";
import { useAuthStore } from "@/stores/authStore";
import { useThemeStore } from "@/stores/themeStore";
import { onMounted, ref } from "vue";
import Avatar from "@/Components/Global/Avatar.vue";
import Search from "@/Components/Global/Search.vue";
import ThemeToggle from "@/Components/Global/ThemeToggle.vue";

const authStore = useAuthStore();
const themeStore = useThemeStore();

onMounted(async () => {
    if (!authStore.user) {
        await authStore.fetchUser();
    }
    themeStore.initTheme();
});

const isShowMenu = ref(false);

const toggleMenu = () => {
    isShowMenu.value = !isShowMenu.value;
};
</script>

<template>
    <header class="bg-theme ">
        <div class="max-sm:px-4 container flex items-center justify-between gap-10 py-8 mx-auto">
            <Link href="/" class="logo-link rounded-xl flex items-center gap-2 px-3 py-2 transition-all duration-300">
                <svg width="32" height="32" viewBox="0 0 72 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                    <path d="M32.0028 24.6869L30.1557 3.76687C30.1557 1.69881 32.5742 0 35.6163 0C38.6637 0 41.0861 1.69881 41.0861 3.76687L39.2345 24.6869C39.0264 25.9469 37.4873 26.9194 35.6142 26.9194C33.7479 26.9194 32.207 25.9469 32.0028 24.6869Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                    <path d="M24.3063 33.4495C25.2422 31.8265 25.1702 30.0113 24.181 29.2029L6.98515 17.1429C5.19918 16.1083 2.51649 17.3537 0.994998 19.9916C-0.531271 22.6265 -0.260524 25.571 1.52515 26.6038L20.5631 35.4692C21.7553 35.9125 23.372 35.0695 24.3063 33.4495Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                    <path d="M46.9299 33.4495C47.8655 35.0704 49.4792 35.9125 50.6708 35.4692L69.712 26.6038C71.5052 25.571 71.7625 22.6265 70.247 19.9916C68.7183 17.3537 66.0329 16.1083 64.2499 17.1429L47.0541 29.2029C46.0705 30.0113 45.9944 31.8289 46.9299 33.4495Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                    <path d="M32.0028 55.2766L30.1557 76.1961C30.1557 78.2671 32.5742 79.962 35.6163 79.962C38.6637 79.962 41.0861 78.2671 41.0861 76.1961L39.2345 55.2766C39.0264 54.0178 37.4873 53.0501 35.6142 53.0501C33.7479 53.0501 32.207 54.0178 32.0028 55.2766Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                    <path d="M47.0541 50.7719L64.2499 62.8227C66.0329 63.8543 68.7183 62.6045 70.2469 59.9752C71.7625 57.3379 71.5051 54.3916 69.712 53.3543L50.6708 44.4994C49.4792 44.0505 47.8675 44.8922 46.9299 46.5149C45.9944 48.134 46.0705 49.954 47.0541 50.7719Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                    <path d="M20.5631 44.4997L1.52515 53.3546C-0.260524 54.3919 -0.531271 57.3382 0.994998 59.9755C2.51649 62.6045 5.19918 63.8546 6.98515 62.823L24.181 50.7722C25.1702 49.954 25.2419 48.1373 24.3069 46.5152C23.3714 44.8922 21.7553 44.0507 20.5631 44.4997Z" :fill="themeStore.isDarkTheme ? '#ffffff' : '#1f2937'"/>
                </svg>
                <h1 class="text-theme text-2xl font-bold">Gorizont</h1>
            </Link>

            <Search />

            <div class="flex items-center gap-4">
                <!-- Переключатель тем -->
                <ThemeToggle />

                <!-- Пользовательское меню или кнопка входа -->
                <div v-if="authStore.user" @click="toggleMenu"
                    class="user-menu relative flex items-center gap-4 p-1 transition-all duration-300 rounded-full cursor-pointer">
                    <Avatar />
                    <transition name="fade">
                        <div v-if="isShowMenu" class="top-14 bg-theme-primary border-theme rounded-2xl w-60 absolute right-0 z-50 px-4 py-3 border shadow-md">
                            <div class="flex flex-col items-start gap-1">
                                <div class=" w-full py-1">
                                    <div class="link_item">
                                        <Avatar />
                                        <div class="flex flex-col items-start gap-1">
                                            <span class="text-theme text-sm leading-none">{{ authStore.user.name }}</span>
                                            <span class="text-theme-secondary text-xs leading-none">{{ authStore.user.email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <Link :href="`/profile/${authStore.user.id}`" class="link_item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-5 text-theme-secondary">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="text-theme">Профиль</span>
                                </Link>
                                <Link href="/settings" class="link_item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-5 text-theme-secondary">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="text-theme">Настройки</span>
                                </Link>
                                <button @click="authStore.logout" class="link_item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 text-theme-secondary">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    <span class="text-theme">Выйти</span>
                                </button>
                            </div>
                        </div>
                    </transition>
                </div>
                <Link v-else href="/login" class="btn btn-primary">Войти</Link>
            </div>
        </div>
    </header>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.logo-link:hover {
    background-color: var(--hover-theme);
}

.user-menu:hover {
    background-color: var(--hover-theme);
}

.link_item {
    @apply flex py-2 rounded-xl transition-all duration-300 px-2 items-center gap-2 w-full font-normal;
    color: var(--text-theme);
}

.link_item:hover {
    background-color: var(--hover-theme);
}

.link_item svg {
    color: var(--text-theme-secondary);
}

header {
    background-color: var(--bg-theme);
}
</style>
