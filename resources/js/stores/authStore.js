import { defineStore } from 'pinia';
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        error: null,
        loading: false,
        toast: useToast(),
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
                router.visit('/');
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
        },
        async updateUser(formData) {
            try {
                const response = await axios.post('/api/user/update-profile', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                
                this.user = response.data;
                this.toast.add({
                    severity: 'success',
                    summary: 'Успешно',
                    detail: 'Профиль успешно обновлен',
                    life: 3000
                });
                this.fetchUser();
                return response.data;
            } catch (error) {
                console.error('Ошибка при обновлении профиля:', error);
                // this.toast.add({
                //     severity: 'error',
                //     summary: 'Ошибка',
                //     detail: 'Ошибка при обновлении профиля',
                //     life: 3000
                // });
                throw error;
            }
        },

        async updatePassword(data) {
            try {
                const response = await axios.post('/api/user/update-password', data);
                this.toast.add({
                    severity: 'success',
                    summary: 'Успешно',
                    detail: 'Пароль успешно обновлен',
                    life: 3000
                });
                return response.data;
            } catch (error) {
                console.error('Ошибка при обновлении пароля:', error);
                this.toast.add({
                    severity: 'error',
                    summary: 'Ошибка',
                    detail: error.response?.data?.message || 'Ошибка при обновлении пароля',
                    life: 3000
                });
                throw error;
            }
        }
    }
}); 