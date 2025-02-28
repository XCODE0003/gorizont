<script setup>
import Dialog from 'primevue/dialog';
import MainLayout from '../../Layouts/MainLayout.vue';
import PostCard from '../../Components/Product/PostCard.vue';
import { ref } from "vue";
import ToggleSwitch from 'primevue/toggleswitch';
import { usePostStore } from '../../stores/postStore';
import Editor from 'primevue/editor';
import FileUpload from 'primevue/fileupload';
import Select from 'primevue/select';
import { onMounted } from 'vue';
import NewCategoryModal from '../../Components/Modal/NewCategoryModal.vue';

const src = ref(null);
const selectedCity = ref();
const checked = ref(true);


const showPopupNewCategory = ref(false);
const postStore = usePostStore();

onMounted(async () => {
    await postStore.getCategories();
});

function onFileSelect(event) {
    const file = event.files[0];
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
        <div class="max-w-xl mx-auto pb-20">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="title">Название статьи</label>
                    <div class="input-wrapper py-3 bg-transparent border border-white/20 rounded-xl">
                        <input type="text" v-model="postStore.title" id="title" class="w-full "
                            placeholder="Название статьи" />
                    </div>
                </div>



                <div class="flex flex-col gap-2">
                    <label for="title">Содержание</label>
                    <Editor name="content" v-model="postStore.content" editorStyle="height: 320px;"
                        class="rounded-2xl " />
                </div>
                <div class="flex flex-col gap-2">
                    <label>Обложка статьи</label>
                    <div class="card flex flex-col items-center gap-6">
                        <div :style="`background-image: url(${src});`"
                            class="bg-primary/50 shadow-md min-h-32 h-full rounded-xl w-full object-cover flex items-center justify-center">
                            <FileUpload mode="basic" @select="onFileSelect" customUpload auto severity="secondary"
                                class="p-button-outlined bg-primary border-none text-white text-sm"
                                chooseLabel="Выбрать изображение" />
                        </div>

                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label>Тематика статьи</label>
                    <Select v-model="postStore.category" emptyMessage="Пока категорий нет" editable :options="postStore.categories" optionLabel="name"
                        placeholder="Выберите тематику" class="w-full md:w-56 border-none bg-primary">
                        <template #footer>
                            <div class="py-1 pb-3 px-2">
                                <div @click="showPopupNewCategory = true" class="btn btn-primary text-sm rounded-lg ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>

                                    Добавить тематику
                                </div>
                            </div>
                        </template>

                    </Select>
                </div>

                <div class="flex items-center gap-2">
                    <ToggleSwitch v-model="postStore.comments" />
                    Включить комментарии
                </div>

                <button @click="postStore.createPost" class="btn btn-secondary py-3 ">
                    Опубликовать
                </button>
            </div>
        </div>
        <Dialog v-model:visible="showPopupNewCategory" modal header="Добавить тематику" :style="{ width: '25rem' }">
            <NewCategoryModal />

        </Dialog>


    </MainLayout>
</template>

<style scoped>
:deep(.p-editor-container) {
    border-radius: 1rem !important;
    overflow: hidden;
}

:deep(.p-editor-toolbar) {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

:deep(.p-editor-content) {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

:deep(.ql-container) {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

:deep(.ql-editor) {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}
</style>