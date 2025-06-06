<script setup>
import { ref, onMounted } from 'vue';
import { useSearchStore } from '@/stores/searchStore';
import { useThemeStore } from '@/stores/themeStore';
import { Link } from '@inertiajs/vue3';

const searchStore = useSearchStore();
const themeStore = useThemeStore();
const focused = ref(false);
const search = ref('');

function handleSearch() {
    focused.value = true;
    searchStore.searchArticles(search.value);
}
</script>

<template>
    <div class="relative flex flex-1">
        <div class="search-input-wrapper z-50">
            <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-icon">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.4169 8.80629C14.7129 10.3113 14.2199 11.7493 13.9079 13.2013C13.8451 13.5113 13.6924 13.7959 13.4688 14.0196C13.2453 14.2433 12.9608 14.3962 12.6509 14.4593C11.2039 14.7683 9.76587 15.2613 8.25487 15.9693C8.06178 16.0592 7.84575 16.0877 7.63596 16.0508C7.42618 16.014 7.23277 15.9136 7.08187 15.7633C6.93092 15.6122 6.83017 15.4182 6.79331 15.2078C6.75645 14.9974 6.78528 14.7807 6.87587 14.5873C7.57787 13.0843 8.07087 11.6443 8.38187 10.1893C8.44463 9.87887 8.59755 9.59386 8.82149 9.36992C9.04544 9.14597 9.33045 8.99305 9.64087 8.93029C11.0929 8.62029 12.5319 8.12729 14.0399 7.42429C14.2331 7.33395 14.4495 7.30539 14.6596 7.34252C14.8696 7.37965 15.0631 7.48065 15.2137 7.63175C15.3642 7.78286 15.4645 7.97672 15.5009 8.18691C15.5372 8.39709 15.5079 8.61338 15.4169 8.80629ZM11.1449 10.4633C10.8181 10.4633 10.5048 10.5931 10.2737 10.8241C10.0427 11.0552 9.91287 11.3685 9.91287 11.6953C9.91287 12.022 10.0427 12.3354 10.2737 12.5664C10.5048 12.7975 10.8181 12.9273 11.1449 12.9273C11.4716 12.9273 11.785 12.7975 12.016 12.5664C12.2471 12.3354 12.3769 12.022 12.3769 11.6953C12.3769 11.3685 12.2471 11.0552 12.016 10.8241C11.785 10.5931 11.4716 10.4633 11.1449 10.4633Z"
                    fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M17.4579 19.4753C17.5579 19.5133 17.6479 19.6033 17.8279 19.7833L20.2839 22.2403C20.4819 22.4373 20.5799 22.5363 20.6879 22.5883C20.7826 22.6338 20.8863 22.6575 20.9914 22.6575C21.0965 22.6575 21.2002 22.6338 21.2949 22.5883C21.4019 22.5363 21.5009 22.4383 21.6979 22.2403C21.8949 22.0423 21.9949 21.9443 22.0459 21.8363C22.0915 21.7416 22.1151 21.6379 22.1151 21.5328C22.1151 21.4277 22.0915 21.324 22.0459 21.2293C21.9949 21.1223 21.8959 21.0233 21.6979 20.8253L19.2429 18.3703C19.0629 18.1903 18.9729 18.1003 18.9339 18.0003C18.9004 17.913 18.8921 17.8181 18.9099 17.7263C18.9299 17.6223 19.0099 17.5093 19.1679 17.2833C20.3145 15.6462 20.9275 13.6949 20.9229 11.6963C20.9229 6.30628 16.5529 1.93628 11.1629 1.93628C5.77289 1.93628 1.40289 6.30628 1.40289 11.6963C1.40289 17.0863 5.77289 21.4563 11.1629 21.4563C13.1578 21.4608 15.1057 20.85 16.7409 19.7073C16.9669 19.5493 17.0799 19.4713 17.1839 19.4503C17.2758 19.4328 17.3707 19.4415 17.4579 19.4753ZM11.1629 19.4573C13.221 19.4573 15.1948 18.6397 16.65 17.1844C18.1053 15.7291 18.9229 13.7554 18.9229 11.6973C18.9229 9.6392 18.1053 7.66541 16.65 6.21013C15.1948 4.75485 13.221 3.93728 11.1629 3.93728C9.10481 3.93728 7.13103 4.75485 5.67574 6.21013C4.22046 7.66541 3.40289 9.6392 3.40289 11.6973C3.40289 13.7554 4.22046 15.7291 5.67574 17.1844C7.13103 18.6397 9.10481 19.4573 11.1629 19.4573Z"
                    fill="currentColor" />
            </svg>

            <input type="text" v-model="search" @focus="focused = true" @blur="focused = false" placeholder="Поиск статей..."
                class="search-input w-full" />
            <transition name="fade-fast">
                <button v-if="search.length > 0" @click="handleSearch" class="search-btn absolute right-2 top-1/2 -translate-y-1/2">
                    Найти
                </button>
            </transition>
        </div>
        <transition name="fade">
            <div v-if="focused" class="search-dropdown absolute left-0 top-14 z-50 w-full">
                <div class="search-results">
                    <Link :href="`/post/view/${item.id}`" v-if="searchStore.articles.length > 0 && search.length > 0" v-for="item in searchStore.articles"
                        class="search-item">
                        <div class="search-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <span class="search-item-text">{{ item.title }}</span>
                    </Link>
                    <div v-else-if="search.length > 0" class="search-empty">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <span>Ничего не найдено по запросу "{{ search }}"</span>
                    </div>
                    <div v-else class="search-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75 12 12m0 0-3.75 3.75M12 12l3.75-3.75M12 12l-3.75-3.75" />
                        </svg>
                        <span>Начните вводить название статьи</span>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <transition name="fade">
        <div v-if="focused" class="search-overlay fixed top-0 left-0 z-40 w-full h-full" @click="focused = false"></div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-fast-enter-active,
.fade-fast-leave-active {
    transition: opacity 0.2s ease;
}

.fade-fast-enter-from,
.fade-fast-leave-to {
    opacity: 0;
}

.search-input-wrapper {
    @apply flex items-center gap-3 px-4 py-3 rounded-xl w-full relative transition-all duration-300;
    background-color: var(--bg-theme-secondary);
    border: 2px solid var(--border-theme);
}

.search-input-wrapper:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-icon {
    color: var(--text-theme-secondary);
    flex-shrink: 0;
}

.search-input {
    background: transparent;
    border: none;
    outline: none;
    color: var(--text-theme);
    font-weight: 500;
}

.search-input::placeholder {
    color: var(--text-theme-muted);
    font-weight: 400;
}

.search-btn {
    @apply px-3 py-1.5 rounded-lg text-sm font-medium transition-all duration-200;
    background-color: #3b82f6;
    color: white;
}

.search-btn:hover {
    background-color: #2563eb;
    transform: translateY(-1px);
}

.search-dropdown {
    background-color: var(--bg-theme-primary);
    border: 2px solid var(--border-theme);
    border-radius: 1rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    max-height: 400px;
    overflow-y: auto;
}

.search-results {
    @apply flex flex-col p-2;
}

.search-item {
    @apply flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 cursor-pointer;
    color: var(--text-theme);
}

.search-item:hover {
    background-color: var(--hover-theme);
    transform: translateX(2px);
}

.search-item-icon {
    @apply flex-shrink-0;
    color: var(--text-theme-secondary);
}

.search-item-text {
    @apply truncate font-medium;
}

.search-empty,
.search-placeholder {
    @apply flex items-center gap-2 px-3 py-4 text-center justify-center;
    color: var(--text-theme-muted);
    font-style: italic;
}

.search-overlay {
    background-color: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(2px);
}

/* Светлая тема - дополнительные тени */
.light .search-dropdown {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}

/* Темная тема - дополнительные тени */
.dark .search-dropdown {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
}
</style>