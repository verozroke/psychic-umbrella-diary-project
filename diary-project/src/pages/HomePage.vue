<template>

    <div class="wrapper">
        <ThemeButton class="theme"/>
        <DialogWindow/>
    </div>

    <!-- Just showing messages iteratively -->
    <!-- <ul>
        <li v-for="message in data" :key="message.id">{{ message.text }} | {{ convertToHMS(message.sended_at) }}</li>
    </ul> -->

</template>

<script setup>
import DialogWindow from '@components/DialogWindow.vue'
import { ref } from 'vue';
import ThemeButton from '../components/entities/ThemeButton.vue';









// getAllMessages()

</script>

<style lang="scss" scoped>

.theme {
    position: absolute;
    top: -.2em;
    left: 11em;
}
</style>