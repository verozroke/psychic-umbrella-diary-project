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


::-webkit-scrollbar {
	width: 13px;
	
	background-color: transparent;
	&-track {
		background-color: transparent;
		margin-block: .5em;
	}
	&-thumb {
		background-color: rgba(47, 47, 47, 0.836);
		border-radius: 100vw;
		transition: .4s;
		border: 4px solid rgba(0, 0, 0, 0);
		background-clip: padding-box;
		&:hover {
			background-color: rgb(28, 28, 28);
			transition: .4s;
		}
	}
	
}


</style>
