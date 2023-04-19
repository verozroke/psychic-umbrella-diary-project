<script setup>
</script>

<template>
  <RouterView/>
</template>

<style lang="scss">
@import '@styles/clearStyles.scss';
@import '@styles/fontStyles.scss';


.wrapper {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    min-height: 100%;
    background-color: #fff;
}

[class*="__container"] {
    max-width: 1260px;
    margin: 0 auto;
    font-family: 'Hind', sans-serif;
    font-size: 16px;
    font-weight: 400;
    font-style: normal;   
}



</style>
