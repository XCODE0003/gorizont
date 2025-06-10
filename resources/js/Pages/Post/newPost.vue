<script setup>
import Dialog from 'primevue/dialog';
import MainLayout from '../../Layouts/MainLayout.vue';
import PostCard from '../../Components/Product/PostCard.vue';
import { ref } from "vue";
import { usePostStore } from '../../stores/postStore';
import { useThemeStore } from '../../stores/themeStore';
import Editor from 'primevue/editor';
import Select from 'primevue/select';
import { onMounted } from 'vue';
import NewCategoryModal from '../../Components/Modal/NewCategoryModal.vue';

const src = ref(null);
const selectedCity = ref();
const checked = ref(true);

const showPopupNewCategory = ref(false);
const postStore = usePostStore();
const themeStore = useThemeStore();

onMounted(async () => {
    await postStore.getCategories();
});

function onFileSelect(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = async (e) => {
        src.value = e.target.result;
    };

    reader.readAsDataURL(file);
    postStore.image = file;
}
</script>

<template>
    <MainLayout>
        <div class="create-post-container">
            <div class="create-post-header">
                <h1 class="page-title">Создание новой статьи</h1>
                <p class="page-subtitle">Поделитесь своими мыслями и идеями с сообществом</p>
            </div>

            <form class="create-post-form" @submit.prevent="postStore.createPost">
                <!-- Название статьи -->
                <div class="form-group">
                    <label for="title" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.691 1.284 3.126 2.955 3.379l14.25 2.161c2.146.325 4.005-1.374 4.005-3.555V4.486c0-2.18-1.859-3.88-4.005-3.555L8.5 3.092C6.284 3.345 5 4.78 5 6.471v9.047c0 .694.57 1.25 1.25 1.25Z" />
                        </svg>
                        Название статьи
                    </label>
                    <div class="enhanced-input-wrapper">
                        <input
                            type="text"
                            v-model="postStore.title"
                            id="title"
                            class="enhanced-input"
                            placeholder="Введите название статьи..."
                            maxlength="200"
                        />
                        <div class="input-counter">{{ postStore.title?.length || 0 }}/200</div>
                    </div>
                </div>

                <!-- Содержание -->
                <div class="form-group">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        Содержание статьи
                    </label>
                    <div class="editor-wrapper">
                        <Editor
                            name="content"
                            v-model="postStore.content"
                            editorStyle="height: 320px; background-color: var(--bg-theme-secondary); color: var(--text-theme);"
                            class="enhanced-editor"
                        />
                    </div>
                </div>

                <!-- Обложка статьи -->
                <div class="form-group">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        Обложка статьи
                    </label>
                    <div class="image-upload-wrapper">
                        <div class="image-preview" :style="src ? `background-image: url(${src}); background-size: cover; background-position: center;` : ''">
                            <div v-if="!src" class="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <p>Нажмите для загрузки изображения</p>
                                <span>JPG, PNG до 5MB</span>
                            </div>
                            <input
                                type="file"
                                @change="onFileSelect"
                                accept="image/*"
                                class="file-input"
                            />
                            <button type="button" class="file-upload-btn">
                                {{ src ? 'Изменить обложку' : 'Выбрать изображение' }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Тематика статьи -->
                <div class="form-group">
                    <label class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                        Тематика статьи
                    </label>
                    <div class="select-wrapper">
                        <Select
                            v-model="postStore.category"
                            emptyMessage="Пока категорий нет"
                            editable
                            :options="postStore.categories"
                            optionLabel="name"
                            placeholder="Выберите тематику статьи..."
                            class="enhanced-select"
                        >
                            <template #footer>
                                <div class="select-footer">
                                    <button
                                        type="button"
                                        @click="showPopupNewCategory = true"
                                        class="add-category-btn"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Добавить новую тематику
                                    </button>
                                </div>
                            </template>
                        </Select>
                    </div>
                </div>

                <!-- Настройки комментариев -->
                <div class="form-group">
                    <div class="checkbox-wrapper">
                        <label class="checkbox-label">
                            <input
                                type="checkbox"
                                v-model="postStore.comments"
                                class="checkbox-input"
                            />
                            <div class="checkbox-custom"></div>
                            <div class="checkbox-content">
                                <h4 class="checkbox-title">Комментарии</h4>
                                <p class="checkbox-description">Разрешить читателям оставлять комментарии к статье</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Кнопка публикации -->
                <div class="form-actions">
                    <button type="submit" class="publish-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        Опубликовать статью
                    </button>
                </div>
            </form>
        </div>

        <Dialog v-model:visible="showPopupNewCategory" modal header="Добавить тематику" :style="{ width: '25rem' }">
            <NewCategoryModal />
        </Dialog>
    </MainLayout>
</template>

<style scoped>
.create-post-container {
    @apply max-w-3xl mx-auto p-6;
}

.create-post-header {
    @apply mb-8 text-center;
}

.page-title {
    @apply text-3xl font-bold mb-2;
    color: var(--text-theme);
}

.page-subtitle {
    @apply text-lg;
    color: var(--text-theme-secondary);
}

.create-post-form {
    @apply space-y-6;
}

.form-group {
    @apply space-y-3;
}

.form-label {
    @apply flex items-center gap-2 text-sm font-semibold;
    color: var(--text-theme);
}

.enhanced-input-wrapper {
    @apply relative;
}

.enhanced-input {
    @apply w-full px-4 py-3 rounded-xl border-2 transition-all duration-200 font-medium;
    background-color: var(--bg-theme-secondary);
    border-color: var(--border-theme);
    color: var(--text-theme);
}

.enhanced-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.enhanced-input::placeholder {
    color: var(--text-theme-muted);
}

.input-counter {
    @apply absolute right-3 top-3 text-xs;
    color: var(--text-theme-muted);
}

.editor-wrapper {
    @apply rounded-xl overflow-hidden border-2;
    border-color: var(--border-theme);
}

.image-upload-wrapper {
    @apply relative;
}

.image-preview {
    @apply relative w-full h-48 rounded-xl border-2 border-dashed overflow-hidden transition-all duration-200;
    border-color: var(--border-theme);
    background-color: var(--bg-theme-secondary);
}

.image-preview:hover {
    border-color: #3b82f6;
}

.upload-placeholder {
    @apply flex flex-col items-center justify-center h-full text-center p-6;
    color: var(--text-theme-muted);
}

.upload-placeholder svg {
    @apply mb-3;
}

.upload-placeholder p {
    @apply font-medium mb-1;
}

.upload-placeholder span {
    @apply text-xs;
}

.file-input {
    @apply absolute inset-0 opacity-0 cursor-pointer z-10;
}

.file-upload-btn {
    @apply absolute bottom-4 right-4 px-4 py-2 text-sm rounded-lg transition-all duration-200;
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
}

.file-upload-btn:hover {
    opacity: 0.8;
}

.select-wrapper {
    @apply relative;
}

.select-footer {
    @apply p-3 border-t;
    border-color: var(--border-theme);
    background-color: var(--bg-theme-secondary);
}

.add-category-btn {
    @apply flex items-center gap-2 w-full px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200;
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
}

.add-category-btn:hover {
    transform: translateY(-1px);
    opacity: 0.8;
}

.checkbox-wrapper {
    @apply p-4 rounded-xl border;
    background-color: var(--bg-theme-secondary);
    border-color: var(--border-theme);
}

.checkbox-label {
    @apply flex items-start gap-3 cursor-pointer;
}

.checkbox-input {
    @apply sr-only;
}

.checkbox-custom {
    @apply w-5 h-5 border-2 rounded transition-all duration-200 flex-shrink-0 mt-0.5;
    border-color: var(--border-theme);
    background-color: var(--bg-theme);
}

.checkbox-input:checked + .checkbox-custom {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.checkbox-input:checked + .checkbox-custom::after {
    content: '✓';
    @apply text-white text-xs flex items-center justify-center w-full h-full;
}

.checkbox-content {
    @apply flex-1;
}

.checkbox-title {
    @apply font-semibold mb-1;
    color: var(--text-theme);
}

.checkbox-description {
    @apply text-sm;
    color: var(--text-theme-secondary);
}

.form-actions {
    @apply pt-6;
}

.publish-btn {
    @apply w-full flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-lg font-semibold transition-all duration-200;
    background-color: var(--btn-primary-bg);
    color: var(--btn-primary-text);
}

.publish-btn:hover {
    transform: translateY(-2px);
    opacity: 0.8;
}

/* PrimeVue стилизация */
:deep(.p-editor-container) {
    border-radius: 0.75rem !important;
    overflow: hidden;
    background-color: var(--bg-theme-secondary) !important;
    border: none !important;
}

:deep(.p-editor-toolbar) {
    background-color: var(--bg-theme-primary) !important;
    border-bottom: 1px solid var(--border-theme) !important;
    color: var(--text-theme) !important;
}

:deep(.p-editor-content) {
    background-color: var(--bg-theme-secondary) !important;
}

:deep(.ql-editor) {
    background-color: var(--bg-theme-secondary) !important;
    color: var(--text-theme) !important;
}

:deep(.ql-editor.ql-blank::before) {
    color: var(--text-theme-muted) !important;
}

:deep(.p-select) {
    background-color: var(--bg-theme-secondary) !important;
    border: 2px solid var(--border-theme) !important;
    border-radius: 0.75rem !important;
    color: var(--text-theme) !important;
}

:deep(.p-select:focus) {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
}

:deep(.p-select-overlay) {
    background-color: var(--bg-theme-primary) !important;
    border: 1px solid var(--border-theme) !important;
    border-radius: 0.75rem !important;
}

:deep(.p-select-option) {
    color: var(--text-theme) !important;
}

:deep(.p-select-option:hover) {
    background-color: var(--hover-theme) !important;
}



:deep(.p-dialog) {
    background-color: var(--bg-theme-primary) !important;
    color: var(--text-theme) !important;
    border: 1px solid var(--border-theme) !important;
}

:deep(.p-dialog-header) {
    background-color: var(--bg-theme-primary) !important;
    color: var(--text-theme) !important;
    border-bottom: 1px solid var(--border-theme) !important;
}
</style>