<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import { ref } from 'vue';
import Profile from '../../Components/Settings/Profile.vue';
import Security from '../../Components/Settings/Security.vue';
import Blacklist from '../../Components/Settings/Blacklist.vue';
const activeTab = ref('profile');
</script>

<template>
    <MainLayout>
        <div class="flex gap-2 max-w-2xl w-full items-start mx-auto ">
            <div class="flex flex-col items-start justify-start py-4 px-3 rounded-xl bg-white/5 gap-2">
                <div class="aside_link" :class="{ active: activeTab === 'profile' }" @click="activeTab = 'profile'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <h1>Профиль</h1>
                </div>
                <div class="aside_link" :class="{ active: activeTab === 'security' }" @click="activeTab = 'security'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                    </svg>

                    <h1>Безопасность</h1>
                </div>
                <!-- <div class="aside_link" :class="{ active: activeTab === 'blacklist' }" @click="activeTab = 'blacklist'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>


                    <h1>Черный список</h1>
                </div> -->

            </div>
            <div class="flex flex-1 bg-white/5 rounded-2xl">
                <Profile v-if="activeTab === 'profile'" />
                <Security v-if="activeTab === 'security'" />
                <Blacklist v-if="activeTab === 'blacklist'" />
            </div>
        </div>
    </MainLayout>
</template>

<style>
.aside_link.active {
    @apply bg-white/10 text-white;
}

.aside_link {
    @apply flex items-center gap-2 font-medium hover:bg-white/10 transition-all w-full text-white/50 hover:text-white cursor-pointer duration-300 px-3 py-2 rounded-lg;
}
</style>