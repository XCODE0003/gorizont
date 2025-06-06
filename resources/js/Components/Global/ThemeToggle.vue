<script setup>
import { useThemeStore } from '@/stores/themeStore';
import { onMounted } from 'vue';

const themeStore = useThemeStore();

onMounted(() => {
    themeStore.initTheme();
});
</script>

<template>
    <div class="theme-toggle-wrapper">
        <button
            @click="themeStore.toggleTheme"
            class="theme-toggle-btn"
            :class="{ 'dark': themeStore.isDarkTheme }"
            :title="themeStore.isDarkTheme ? 'Переключить на светлую тему' : 'Переключить на темную тему'"
        >
            <!-- Фон переключателя -->
            <div class="toggle-track">
                <!-- Ползунок -->
                <div class="toggle-thumb" :class="{ 'dark': themeStore.isDarkTheme }">
                    <!-- Иконка солнца (светлая тема) -->
                    <svg
                        v-show="!themeStore.isDarkTheme"
                        class="icon sun-icon"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            clip-rule="evenodd"
                        />
                    </svg>

                    <!-- Иконка луны (темная тема) -->
                    <svg
                        v-show="themeStore.isDarkTheme"
                        class="icon moon-icon"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                        />
                    </svg>
                </div>
            </div>
        </button>
    </div>
</template>

<style scoped>
.theme-toggle-wrapper {
    @apply flex items-center;
}

.theme-toggle-btn {
    @apply relative inline-flex items-center cursor-pointer p-1 rounded-full transition-all duration-300;
    background: transparent;
    border: none;
    outline: none;
}

.theme-toggle-btn:hover {
    @apply scale-105;
}

.theme-toggle-btn:active {
    @apply scale-95;
}

.toggle-track {
    @apply relative flex items-center w-14 h-7 rounded-full transition-all duration-300;
    background: var(--border-theme);
    border: 1px solid var(--border-theme);
}

.toggle-thumb {
    @apply absolute flex items-center justify-center w-6 h-6 rounded-full shadow-md transition-all duration-300 ease-in-out;
    left: 1px;
    background: var(--bg-theme);
    border: 1px solid var(--border-theme);
}

.toggle-thumb.dark {
    transform: translateX(26px);
}

.icon {
    @apply w-4 h-4 transition-all duration-300;
}

.sun-icon {
    color: #f59e0b;
}

.moon-icon {
    color: #6366f1;
}

/* Дополнительные стили для анимации */
.toggle-track {
    background: linear-gradient(to right,
        var(--hover-theme) 0%,
        var(--bg-theme-secondary) 100%
    );
}

.theme-toggle-btn:hover .toggle-track {
    box-shadow: 0 0 10px rgba(99, 102, 241, 0.3);
}

.dark .theme-toggle-btn:hover .toggle-track {
    box-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
}

/* Responsive */
@media (max-width: 640px) {
    .toggle-track {
        @apply w-12 h-6;
    }

    .toggle-thumb {
        @apply w-5 h-5;
    }

    .toggle-thumb.dark {
        transform: translateX(22px);
    }

    .icon {
        @apply w-3 h-3;
    }
}
</style>