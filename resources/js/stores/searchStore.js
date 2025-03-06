import { defineStore } from 'pinia';
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
export const useSearchStore = defineStore('search', {
    state: () => ({
        articles: [],
        error: null,
        loading: false,
        toast: useToast(),
    }),
    actions: {
        async searchArticles(query) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.post('/post/search', { query });
                this.articles = response.data.articles;
            } catch (error) {
                this.error = error.response?.data?.message || 'Ошибка при поиске статей';
            } finally {
                this.loading = false;
            }
        },
        
    }
}); 