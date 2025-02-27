<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
import { ref } from "vue";
import ToggleSwitch from 'primevue/toggleswitch';
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import Editor from 'primevue/editor';
import FileUpload from 'primevue/fileupload';

const src = ref(null);

function onFileSelect(event) {
    const file = event.files[0];
    const reader = new FileReader();

    reader.onload = async (e) => {
        src.value = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

<template>
    <MainLayout>
        <div class="max-w-xl mx-auto pb-20">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="title">Название статьи</label>
                    <div class="input-wrapper py-3 bg-transparent border border-white/20 rounded-xl">
                        <input type="text" id="title" class="w-full " placeholder="Название статьи"/>
                    </div>
                </div>
                
        
                
                <div class="flex flex-col gap-2">
                    <label for="title">Содержание</label>
                    <Editor name="content" editorStyle="height: 320px;" class="rounded-2xl " />
                </div>
                <div class="flex flex-col gap-2">
                    <label>Обложка статьи</label>
                    <div class="card flex flex-col items-center gap-6">
                        <div :style="`background-image: url(${src});`" class="bg-primary/50 shadow-md min-h-32 h-full rounded-xl w-full object-cover flex items-center justify-center">
                            <FileUpload mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined bg-primary border-none text-white text-sm" chooseLabel="Выбрать изображение" />
                        </div>
                       
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <ToggleSwitch v-model="checked" />
                    Включить комментарии
                </div>

                <div class="btn btn-secondary py-3 ">
                    Опубликовать
                </div>
            </div>
        </div>
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