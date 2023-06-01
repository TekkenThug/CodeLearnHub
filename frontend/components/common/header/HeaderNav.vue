<template>
    <ul :class="$style.navList">
        <li
            v-for="item in items.filter(item => item.visible)"
            :key="item.name"
            :class="$style.navItem"
            @click="item.callback"
        >
            <NuxtLink
                v-if="item.link"
                :to="item.link"
            >
                {{ item.name }}
            </NuxtLink>

            <template v-else>
                {{ item.name }}
            </template>
        </li>
    </ul>
</template>

<script lang="ts" setup>
const props = defineProps<{
    items: {
        name: string,
        link?: string,
        visible: boolean
        callback?: Function
    }[]
}>()
</script>

<style lang="sass" module>
.navList
    display: flex
    flex-shrink: 0
    gap: $offset-m
    margin-left: auto

    @include responsive($mobile)
        @include trans
        position: absolute
        right: 0
        top: 0
        height: 100vh
        width: 320px
        padding: $offset-s
        flex-direction: column
        background-color: $white

.navItem
    @include l2
    color: $blue-dark-card
    cursor: pointer

    @include hover
        color: $blue-dark

    & > a
        @include trans
</style>
