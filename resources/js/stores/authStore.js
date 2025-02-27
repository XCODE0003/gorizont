import { defineStore } from 'pinia';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        error: null,
        loading: false,
    }),
    actions: {
        async login(credentials) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.post('/api/login', credentials);
                this.user = response.data.user;
                router.visit('/');
            } catch (error) {
                this.error = error.response?.data?.message || 'Ошибка авторизации';
            } finally {
                this.loading = false;
            }
        },
        async register(userData) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.post('/api/register', userData);
                this.user = response.data.user;
            } catch (error) {
                this.error = error.response?.data?.message || 'Ошибка регистрации';
            } finally {
                this.loading = false;
            }
        },
        async logout() {
            try {
                await axios.post('/api/logout');
                this.user = null;
                router.visit('/login');
            } catch (error) {
                console.error('Ошибка при выходе:', error);
            }
        },
        async fetchUser() {
            try {
                const response = await axios.get('/api/user');
                this.user = response.data;
            } catch (error) {
                this.user = null;
            }
        }
    }
}); 