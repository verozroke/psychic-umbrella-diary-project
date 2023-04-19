<template>
    <div class="time">
        {{ new Date(timeUnixRef * 1000).toLocaleString("ru-RU", {day: "numeric"})}} 
        {{ new Date(timeUnixRef * 1000).toLocaleString("ru-RU", {month: "long"}) }}
        {{new Date(timeUnixRef * 1000).toLocaleString("en-US", {year: "2-digit"}) > 23 ? '19' + new Date(timeUnixRef * 1000).toLocaleString("en-US", {year: "2-digit"}) : '20' + new Date(timeUnixRef * 1000).toLocaleString("en-US", {year: "2-digit"}) }}

    </div>
</template>

<script setup>
import { ref, toRef } from 'vue';


const props = defineProps({
    timeUnix: Number,
})


const timeUnixRef = toRef(props, 'timeUnix')



const month = ref(new Date(timeUnixRef.value * 1000).toLocaleString("ru-RU", {month: "long"})) // December
const day = ref(new Date(timeUnixRef.value * 1000).toLocaleString("ru-RU", {day: "numeric"})) // 9
const year = ref(new Date(timeUnixRef.value * 1000).toLocaleString("en-US", {year: "2-digit"})) // 2019

</script>

<style lang="scss" scoped>

.time {
    width: 100%;
    text-align: center;
    line-height: 1.4em;
    font-family: 'Nunito' ,sans-serif;
    font-weight: 500; 
    letter-spacing: 1px;
}

</style>