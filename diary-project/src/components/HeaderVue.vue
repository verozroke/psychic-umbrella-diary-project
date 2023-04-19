<template>
    <div class="header">
        <div class="header__container">
            <a href="https://verozroke.github.io/askatti-bugatti/" target="_blank" class="header__title">
                дневник асхата
            </a>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>

.header {
    z-index: 10000;
    min-height: 75px;
    transition: .4s;
    // background-color: #333333;
    border-bottom-left-radius: 1.4em;
    border-bottom-right-radius: 1.4em;
    // filter: drop-shadow(0em .5em .5em rgba(0, 0, 0, .5));
    &__container {
        line-height: 1.4em;
        font-family: 'Montserrat', sans-serif;
        width: 100%;
        min-height: 100%;
        font-weight: 500;
        letter-spacing: .3em;
        display: flex;
        justify-content: center;
        align-items: center;
        // color: rgb(169, 169, 169);
    }
    &__title {
        text-align: center;
        font-size: 18px;
        cursor: pointer;
		position: relative;
		transition: .4s;
        // color: rgb(169, 169, 169);
        &:visited {
            // color: rgb(169, 169, 169);
        }
        &:hover {
            // color: #fff;
        }
		&::after {
			content: '';
			position: absolute;
			width: 100%;
			transform: scaleX(0);
			height: 1.5px;
			bottom: -5px;
			left: 0;
			// background-color: #fff;
			transform-origin: bottom right;
			transition: transform .4s ease-out;
		}
		&:hover::after {
			transform: scaleX(1);
			transform-origin: bottom left;
		}
		
		&:hover {
			transition: .4s;
		}
    }
}


</style>