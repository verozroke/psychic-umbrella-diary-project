<template>
    <UIMessage class="message" >
        <ul v-if="!isMessageInputOpen" class="message__functions">
            <li @click="changeToMessageInput" class="message__function-button"><img id="edit-icon" src="/img/edit.png" alt="edit"></li>
            <li @click="deleteMessage" class="message__function-button"><img id="garbage-icon" src="/img/garbage.png" alt="garbage"></li>
        </ul>
        <div class="message__avatar" >
            <label for="thumbnail">
                <div class="message__avatar-overlay"><img src="/img/edit.png" alt=""></div>
                <img :src="imagePathRef" alt="">
            </label>
            <input style="display: none;" @change="uploadAvatar" ref="thumbnail" type="file" id="thumbnail">
        </div>
        <div class="message__box">
            <div class="message__info">
                <input id="nickname-input" v-model="userNicknameInput" v-if="isInputOpen" @keypress.enter="changeNickName" type="text" style="margin-right: .5em; font-weight: 700; font-size: 18px;">
                <b v-else @click="changeToInput" style="margin-right: .5em;">{{ nicknameRef }}</b>
                {{ convertToHMS(message.sended_at) }}
            </div>
            <textarea id="message-input" v-model="messageTextInput" v-if="isMessageInputOpen" @keypress.enter="editMessage" type="text" style="font-size: 16px;" class="message__text"></textarea>
            <div v-else class="message__text">
                {{ message.text }}
            </div>
            <ul v-if="isMessageInputOpen" class="message__text-buttons">
                <li @click="editMessage" class="message__text-button">
                    <img src="/img/checkmark.png" alt="">
                </li>
                <li @click="changeToMessageInput" class="message__text-button">
                    <img src="/img/cross-mark.png" alt="">
                </li>
            </ul>
        </div>
    </UIMessage>
</template>

<script setup>
import axios from 'axios';
import UIMessage from './UI/UIMessage.vue';
import { ref, toRef } from 'vue';

const emit = defineEmits(['delete'])

const props = defineProps({
    message: Object,
    user: Object,
})



const userNicknameInput = ref(props.user.nickname)
const isInputOpen = ref(false)


// to refed nickname of parent
const nicknameRef = toRef(props.user, 'nickname')
const imagePathRef = toRef(props.user, 'image_path')



const isMessageInputOpen = ref(false)
const messageTextInput = ref(props.message.text)

const isDeleted = ref(false)


const changeToMessageInput = () => {
    messageTextInput.value = props.message.text
    isMessageInputOpen.value = !isMessageInputOpen.value    
}

const thumbnail = ref(null)

function gatherFormData() {
    const data = new FormData();
    data.append('thumbnail', thumbnail.value.files[0]);
    return data;
}


const uploadAvatar = async () => {
    var formData = gatherFormData()
    const { data } = await axios.post('https://psychic-umbrella-diary-project-production.up.railway.app/api/file/upload/1', 
    formData, {
        headers: { 'Content-Type': 'multipart/form-data'}
    })
    imagePathRef.value = data.image_path
}


const editMessage = async ($e) => {
    const keyCode = $e.which || $e.keyCode;
    // clicking by mouse gives undefined 
    // (the only way to call this func is clicking enter and clicking to button. 
    // enter's keyCode is 13, mouse click keyCode is undefined)
    if ((keyCode === 13 && !$e.shiftKey) || !$e.keyCode) {
        $e.preventDefault();
        props.message.text = messageTextInput.value
        await axios.put(`https://psychic-umbrella-diary-project-production.up.railway.app/api/message/update/${props.message.id}`, {
            text: props.message.text
        }, {
            headers: { 'Content-Type': 'application/json' }
        })
        changeToMessageInput()
    }
}

const deleteMessage = async () => {
    emit('delete', props.message.id)    
    await axios.delete(`https://psychic-umbrella-diary-project-production.up.railway.app/message/delete/${props.message.id}`, {
        headers: { 'Content-Type': 'application/json' }
    })
}

const changeNickName = async () => {
    nicknameRef.value = userNicknameInput.value
    changeToInput()
    await axios.put('https://psychic-umbrella-diary-project-production.up.railway.app/api/person/update/name', {
        id: 1,
        nickname: nicknameRef.value
    }, {
        headers: {'Content-Type': 'application/json'}
    })
}


const changeToInput = () => {
    isInputOpen.value = !isInputOpen.value
    if(isInputOpen.value) {
        setTimeout(() => {
            document.querySelector('#nickname-input').focus()
        }, 0)
    }
    
}

const convertToHMS = (unixTimestamp) => {
    var date = new Date(unixTimestamp * 1000);

    var hours = date.getHours();
    hours =  hours.toString().length === 1 ? '0' + hours : hours

    var minutes = date.getMinutes();
    minutes = minutes.toString().length === 1 ? '0' + minutes : minutes 

    var formattedTime = hours + ':' + minutes;
    return formattedTime
}



</script>

<style lang="scss" scoped>

.message {
    transition: .4s;    
    display: flex;
    gap: 1em;
    font-family: 'Nunito' ,sans-serif;
    &:hover {
        transition: .4s;
        & .message__functions {
            opacity: 1;
            transition: .4s;
        }
        filter: drop-shadow(0em 0.2em 0.2em rgba(0, 0, 0, .6));
        
    }
    &__avatar {
        position: relative;
        padding: 10px 0 10px 0;
        height: 100%;
        width: 75px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        & img {
            border-radius: 50%;
            object-fit: cover;
            height: 55px;
            width: 55px;
        }
        &:hover .message__avatar-overlay {
            opacity: 1;
            transition: .4s;
        }
    }
    &__avatar-overlay {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        transition: .4s;
        opacity: 0;
        background-color: rgba(0, 0, 0, 0.592);
        & img {
            filter: invert(100%);
            width: 25px;
            height: 25px;
        }
    }
    &__box {
        flex: 1 1 auto;
        display: flex;
        gap: 5px;
        flex-direction: column;
        padding: 10px 0 10px 0
    }
    &__info {
        transition: .4s ;
        font-weight: 700;
        height: 20px;
        font-size: 18px;
        line-height: 1.4em;
        display: flex;
        align-items: center;
    }
    &__text {
        line-height: 1.4em;
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        font-weight: 400;
        justify-content: center;
    }
    &__functions {
        border-radius: .5em;
        opacity: 0;
        transition: .4s;
        position: absolute;
        right: 10px;
        top: 10px;
        display: flex;
    }
    &__function-button {
        &:first-child {
            border-top-left-radius: .5em;
            border-bottom-left-radius: .5em;
        }
        &:last-child {
            border-top-right-radius: .5em;
            border-bottom-right-radius: .5em;
        }
        display: flex;
        justify-content: center;
        align-items: center;
        height: 30px;
        width: 30px;
        & img {
            height: 20px;
            width: 20px;
        }
    }
    &__text-buttons {
        border-radius: .5em;
        transition: .4s;
        display: flex;
        width: 60px;
        margin-top: 0.5em;
        margin-left: auto;
    }
    &__text-button {
        &:first-child {
            border-top-left-radius: .5em;
            border-bottom-left-radius: .5em;
        }
        &:last-child {
            border-top-right-radius: .5em;
            border-bottom-right-radius: .5em;
        }
        display: flex;
        justify-content: center;
        align-items: center;
        height: 30px;
        width: 30px;
        & img {
            height: 17px;
            width: 17px;
        }
    }
}




</style>