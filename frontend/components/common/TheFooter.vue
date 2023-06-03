<template>
    <footer :class="$style.Footer">
        <div class="container">
            <div>
                <div :class="$style.top">
                    <div
                        v-for="column in columns"
                        :key="column.title"
                        :class="$style.column"
                    >
                        <h3 :class="$style.columnTitle">
                            {{ column.title }}
                        </h3>

                        <ul :class="$style.columnList">
                            <li
                                v-for="item in column.items"
                                :key="item.link"
                                :class="$style.columnItem"
                            >
                                <NuxtLink :to="item.link">
                                    {{ item.title }}
                                </NuxtLink>
                            </li>
                        </ul>
                    </div>
                </div>

                <div :class="$style.bottom">
                    <NuxtLink to="/">
                        <img
                            :class="$style.logo"
                            src="~/assets/images/common/logo.png"
                            alt="Logo"
                        >
                    </NuxtLink>

                    <ul :class="$style.socialButtonList">
                        <li
                            v-for="item in socialLinks"
                            :key="item.link"
                            :class="$style.socialButton"
                        >
                            <a :href="item.link">
                                <svg-icon :name="item.icon" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { useCourseStore } from '~/stores/course'

const courseStore = useCourseStore()
const columns = computed(() => ([
    {
        title: 'Полезное',
        items: [
            {
                title: 'Новости',
                link: '/updates'
            },
            {
                title: 'Контакты',
                link: '/contacts'
            },
            {
                title: 'Стать автором',
                link: '/courses/create'
            }
        ]
    },
    {
        title: 'Курсы',
        items: [...courseStore.popularCourses.map(item => ({
            link: `/courses/${item.id}`,
            title: item.name
        }))]
    }
]))

const socialLinks = ref([
    {
        link: 'https://vk.com/',
        icon: 'vk'
    },
    {
        link: 'https://telegram.org/',
        icon: 'telegram'
    }
])
</script>

<style lang="sass" module>
.Footer
    padding: $offset-xl 0
    display: flex
    flex-direction: column

    @include responsive($mobile)
        padding: $offset-m 0

.top
    display: flex
    margin-bottom: 50px
    gap: $offset-l

    @include responsive($mobile)
        margin-bottom: 25px

.columnTitle
    @include p1
    flex-shrink: 0
    color: $blue-main
    margin-bottom: 8px

.columnItem
    @include trans
    @include hover
        color: $blue-main

.columnList
    display: flex
    flex-direction: column
    gap: 8px

.bottom
    display: flex
    justify-content: space-between
    align-items: center

.logo
    width: 72px
    height: 40px

.socialButtonList
    display: flex
    align-items: center
    gap: $offset-xxs

.socialButton
    @include trans
    flex-shrink: 0
    display: flex
    align-items: center
    justify-content: center
    border-radius: 50%
    width: 37px
    height: 37px
    color: $blue-main

    @include hover
        color: $blue-dark-card
        border-color: $blue-dark-card

    & > a
        display: flex
        justify-content: center
        align-items: center
        width: 100%
        height: 100%

    svg
        width: 100%
        height: 100%
</style>
