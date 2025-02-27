<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import PostCard from '../Components/Product/PostCard.vue';
</script>

<template>
    <MainLayout>
       <div class="container mx-auto">
            <div class="grid grid-cols-4 gap-4">
                <PostCard v-for="i in 8" image="/assets/images/cat.jpeg" title="Title" description="Description" views="100" createdAt="2021-01-01" author="John Doe" />
            </div>
       </div>
    </MainLayout>
</template>