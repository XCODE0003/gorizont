<script setup>
import Header from '../Components/Header.vue';
import Toast from 'primevue/toast';
</script>

<template>
    <Header />
    <div class="flex gap-2 page-wrapper">
   
            <slot />
 
    </div>
    <Toast />
</template>

<style>

.page-wrapper > *:not([data-inertia-transition-status]) {
    animation: pageEnter 0.3s ease forwards;
}

.page-wrapper > *[data-inertia-transition-status="leaving"] {
    animation: pageLeave 0.3s ease forwards;
    position: absolute;
    width: 100%;
    top: 0;
}

@keyframes pageEnter {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translate(0);
    }
}

@keyframes pageLeave {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-10px);
    }
}
</style>