<template>
    <div>
        <div>
            {{ person.nickname }} <br>
            <img :src="person.image_path" alt="" style="width: 300px;">
            <label for="">Put your image</label>
            <input @change="changeThumbnail" ref="thumbnail" type="file" name="thumbnail">
        </div>
        <button @click="upload">Upload</button>
    </div>
</template>

<script setup>
import axios from 'axios'
import { onMounted, ref } from 'vue';

const thumbnail = ref(null)


const person = ref({})

function gatherFormData() {
    const data = new FormData();
    data.append('thumbnail', thumbnail.value.files[0]);
    return data;
}


const upload = async () => {
    var formData = gatherFormData()
    const response = await axios.post('http://localhost:8000/api/file/upload', 
    formData, {
        headers: { 'Content-Type': 'multipart/form-data'}
    })
}


onMounted( async () => {
    const { data } = await axios.get('http://localhost:8000/api/person/1', {
        headers: { 'Content-Type': 'application/json' }
    })
    person.value = data
})

</script>

<style lang="scss" scoped>

</style>