import { defineStore } from 'pinia';
import axios from 'axios';
import { useToast } from 'primevue/usetoast';
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

export const usePostStore = defineStore('post', {
    state: () => ({
        categories: [],
        loading: false,
        error: null,
        title: '',
        content: '',
        category: null,
        image: null,
        comments: true,
        toast: useToast(),
    }),
    actions: {
        async getCategories(){
            this.loading = true;
            const response = await axios.get('/category');
            this.categories = response.data.categories;
            this.loading = false;
        },
        async addCategory(name){
            try {
                const response = await axios.post('/category/new', { name });
                if(response.status === 200) {
                    this.categories.push(response.data.categories);
                    this.toast.add({ severity: 'success', summary: 'Успешно', detail: 'Категория добавлена', life: 3000 });
                    this.getCategories();
                }
            } catch(error) {
                this.toast.add({ severity: 'error', summary: 'Ошибка', detail: error.response.data.message , life: 3000 });
            }
        },
        async savePost(id){
            try {
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('content', this.content);
                formData.append('category_id', this.category.id);
                formData.append('comment', this.comments ? 1 : 0);
                
                if (this.image) {
                    formData.append('image', this.image);
                }
                
                const response = await axios.post('/post/'+id+'/edit', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                if(response.status === 200) {
                    this.toast.add({ severity: 'success', summary: 'Успешно', detail: 'Статья успешно отредактирована', life: 3000 });
                }
            } catch(error) {
                this.toast.add({ severity: 'error', summary: 'Ошибка', detail: error.response.data.message , life: 3000 });
            }
        },
        async createPost(){
            try {
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('content', this.content);
                formData.append('category_id', this.category.id);
                formData.append('comment', this.comments ? 1 : 0);
                
                if (this.image) {
                    formData.append('image', this.image);
                }
                
                const response = await axios.post('/post/new', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                
                if(response.status === 200) {
                    this.toast.add({ severity: 'success', summary: 'Успешно', detail: 'Статья успешно создана', life: 3000 });
                    console.log(response.data);
                    router.visit('/post/'+response.data.article.id);
                }
            } catch(error) {
                console.log(error);
                this.toast.add({ severity: 'error', summary: 'Ошибка', detail: error.response.data.message , life: 3000 });
            }
        },
        async deletePost(id){
            try {
                const response = await axios.delete('/post/'+id+'/delete');
                if(response.status === 200) {
                    this.toast.add({ severity: 'success', summary: 'Успешно', detail: 'Статья успешно удалена', life: 3000 });
                    const userId = usePage().props.auth.user.id;
                    router.visit('/profile/'+userId);
                }
            } catch(error) {
                console.log(error);
                this.toast.add({ severity: 'error', summary: 'Ошибка', detail: error.response.data.message , life: 3000 });
            }
        }
    }
}); 