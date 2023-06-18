<template>
    <div :class="$style.TestFlight">
        <div class="container">
            Cайт находится в тестовом режиме.
            <!--            По всем техническим вопросам обращаться <a href="mailto:ignatov0131@gmail.com">ignatov0131@gmail.com</a>.-->
            Версия сайта - {{ version }}
        </div>
    </div>
</template>

<script lang="ts" setup>
const version = ref('0.3.0')
</script>

<style module lang="sass">
.TestFlight
    position: sticky
    padding: 8px 0
    width: 100%
    background-color: $blue-main
    text-align: center
    color: #fff
    font-size: 12px
    font-weight: 600
    bottom: 0
    z-index: $z-test-flight

    @include responsive($mobile)
        position: static

    a
        text-decoration: underline
</style>
