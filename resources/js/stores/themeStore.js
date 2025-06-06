import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useThemeStore = defineStore('theme', () => {
    // Состояние темы (по умолчанию темная)
    const isDarkTheme = ref(true);

    // Загрузка темы из localStorage при инициализации
    const initTheme = () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            isDarkTheme.value = savedTheme === 'dark';
        } else {
            // Если нет сохраненной темы, используем системную
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            isDarkTheme.value = prefersDark;
        }
        applyTheme();
    };

    // Применение темы к документу
    const applyTheme = () => {
        if (isDarkTheme.value) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }
    };

    // Переключение темы
    const toggleTheme = () => {
        isDarkTheme.value = !isDarkTheme.value;
        localStorage.setItem('theme', isDarkTheme.value ? 'dark' : 'light');
        applyTheme();
    };

    // Установка конкретной темы
    const setTheme = (theme) => {
        isDarkTheme.value = theme === 'dark';
        localStorage.setItem('theme', theme);
        applyTheme();
    };

    // Computed свойства для удобства
    const currentTheme = computed(() => isDarkTheme.value ? 'dark' : 'light');
    const isLightTheme = computed(() => !isDarkTheme.value);

    // CSS классы для текущей темы
    const themeClasses = computed(() => ({
        body: isDarkTheme.value ? 'bg-body-dark text-white' : 'bg-body-light text-gray-900',
        primary: isDarkTheme.value ? 'bg-primary-dark' : 'bg-primary-light',
        secondary: isDarkTheme.value ? 'bg-secondary-dark' : 'bg-secondary-light',
        border: isDarkTheme.value ? 'border-white/20' : 'border-gray-300',
        text: {
            primary: isDarkTheme.value ? 'text-white' : 'text-gray-900',
            secondary: isDarkTheme.value ? 'text-white/60' : 'text-gray-600',
            muted: isDarkTheme.value ? 'text-white/40' : 'text-gray-400',
        },
        hover: isDarkTheme.value ? 'hover:bg-white/10' : 'hover:bg-gray-100',
    }));

    return {
        // State
        isDarkTheme,
        isLightTheme,
        currentTheme,
        themeClasses,

        // Actions
        initTheme,
        toggleTheme,
        setTheme,
        applyTheme,
    };
});