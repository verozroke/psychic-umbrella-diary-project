<template>
    <div class="caption">
        <div class="caption__container">
            <div class="caption__line"></div>
            <div class="caption__title">Добро пожаловать! Здесь те вещи которыми я занимаюсь каждый день</div>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>

.caption {
    margin-top: 1em;
    transition: .4s;
    min-height: 75px;
    background-color: transparent !important;
    &__container {
        width: 100%;
        height: 100%;
        line-height: 1.4em;
        font-family: 'Nunito' ,sans-serif;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        font-weight: 500;
        letter-spacing: .8px;
        // color: #7c7c7c;
    }
    &__line {
        border-radius: 1em;
        // background: linear-gradient(90deg, rgba(127, 127, 127, 0) 0%, rgba(127, 127, 127, 0.4) 2%, rgba(127, 127, 127, 0.4) 98%, rgba(127, 127, 127, 0) 100%);
        height: 1px;
        margin: 0 0 1.5em 0;
        width: 1000px;
    }
    &__title {
        text-align: center;
        font-size: 16px;
    }
}

</style>