<template>
        <div class="window">
            <div class="window__container">
                <HeaderVue/>
                <div class="loading"></div>
                <main ref="messages" class="window__messages">
                    <!-- <UIDateTime :timeUnix="1680530725095"/> -->
                    <div class="window__day-block day-block" v-for="(dayBlock, index) in messagesData">
                        <div class="day-block__time"><UIDateTime  :time-unix="dayBlock[0].sended_at"/></div>
                        <div class="day-block__list">
                            <transition-group name="message-list" tag="ul" appear>
                                <MessageBlock @delete="deleteMessageBlock" v-for="message in dayBlock" :message="message" :user="user" :key="message.id" :id="`messageContainer-${message.id}`" />
                            </transition-group>
                        </div>
                    </div>
                </main>
                <Caption/>
            </div>
        </div>
</template>

<script setup>
import HeaderVue from './HeaderVue.vue';
import Caption from '@components/Caption.vue'
import UIDateTime from './UI/UIDateTime.vue';
import MessageBlock from './MessageBlock.vue';
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios'


const messages = ref(null)
const bottom = ref(0)
const messagesData = ref([])

let user;



const deleteMessageBlock = (id) => {
    console.log(messagesData.value)
    const myArray = []
    messagesData.value.forEach((dayBlock, index) => {
        const dayBlockToPush = dayBlock.filter(message => message.id !== id)
        if(dayBlockToPush.length === 0) {
            return
        }
        myArray.push(dayBlockToPush)
    })
    console.log(myArray);
    messagesData.value = myArray
}


const scrollToBottomOfChat = () => {
    bottom.value = messages.value.scrollHeight
    messages.value.scrollTo(0, bottom.value)
}



async function getAllMessages() {
    const response = await axios.get('http://localhost:8000/api/message/all', {
        headers: {'Content-Type': 'application/json'}
    })
    messagesData.value = response.data[0];

    messagesData.value.sort(function(a, b){
        return new Date(b.sended_at) - new Date(a.sended_at);
    }).reverse();

    messagesData.value  = Object.values(messagesData.value.reduce((acc, message) => {
        const date = new Date(message.sended_at * 1000);
        date.setUTCHours(date.getUTCHours() + 6);   
        const day = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate()));    
        if (!acc[day]) {
            acc[day] = [];
        }
        
        acc[day].push(message);
        
        return acc;
    }, {}));
    
}

onMounted(async () => {
    const { data }  = await axios.get('http://localhost:8000/api/person/1', {
        headers: {'Content-Type': 'application/json'}
    })
    user = ref(data)
    await getAllMessages()
    scrollToBottomOfChat()
})

</script>

<style lang="scss" scoped>

.window {
    transition: .4s;
    // background-color: #121212;
    height: 100vh;
    &__container {
        transition: .4s;
        display: flex;
        flex-direction: column;
        // background-color: #212121;
        width: 100%;
        height: 100%;
        // filter: drop-shadow(0em 0em 2em rgba(0, 0, 0, .5))
    }
    &__messages {
        padding: 2em 0;
    }
    &__day-block {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 2em;
    }
}

.day-block {
    width: 100%;
    &__list {
        display: flex;
        flex-direction: column;


        justify-content: center;
        align-items: center;
        width: 100%;
        gap: 1em;
        & ul {
            display: flex;
            flex-direction: column;
            position: relative;
            justify-content: center;
            align-items: center;
            width: 100%;
            gap: 1em;
        }
    }
}


main {
    flex: 1 1 auto;
    gap: 2em;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    overflow-y: auto;
}


.message-list {
    &-enter-from {
        opacity: 0;
        transform: scale(0.6);
    }
    &-enter-to {
        opacity: 1;
        transform: scale(1);
    }
    &-enter-active {
        transition: all .4s ease
    }

    &-leave-from {
        opacity: 1;
        transform: scale(1);
    }
    &-leave-to {
        opacity: 0;
        transform: scale(0.6);
    }
    &-leave-active {
        transition: all .4s ease;
        position: absolute;
    }
    &-move {
        transition: all .3s ease;
    }
}


</style>