<template>
    <main class="page">
        <div class="container">
            <h1 :class="$style.title">
                Обновления и новости
            </h1>

            <transition name="fade" mode="out-in">
                <div
                    v-if="isLoading"
                    :class="$style.loaderWrapper"
                >
                    <UiLoader />
                </div>

                <ul v-else-if="updates.length">
                    <li
                        v-for="item in updates"
                        :key="item.title + item.date"
                        :class="$style.article"
                    >
                        <div :class="$style.articleTop">
                            <h3 :class="$style.articleTitle">
                                {{ item.title }}
                            </h3>

                            <strong :class="$style.articleDate">
                                Дата: {{ item.added_at }}
                            </strong>
                        </div>

                        <UiEditorBlockWrap :blocks="item.text" />
                    </li>
                </ul>

                <h2 v-else>
                    Новостей нет
                </h2>
            </transition>
        </div>
    </main>
</template>

<script setup>
import { useUserStore } from '~/stores/user'
import UiEditorBlockWrap from '~/components/ui/blocks/UiEditorBlockWrap'

const isLoading = ref(true)
const user = useUserStore()
const updates = ref([])

onBeforeMount(async() => {
    updates.value = await user.getNews()
    isLoading.value = false
})
</script>

<style lang="sass" module>
.loaderWrapper
    display: flex
    justify-content: center
    align-items: center

.title
    @include h1
    color: $blue-main
    margin-bottom: $offset-xl

.article
    &:not(:first-child)
        padding-top: 40px

    &:not(:last-child)
        position: relative
        padding-bottom: 40px
        border-bottom: 1px solid $gray-100

.articleTop
    margin-bottom: $offset-l
    color: $blue-dark-card

.articleTitle
    @include h2
    font-size: 24px
    margin-bottom: 5px

.articleDate
    font-weight: 500
    font-size: 14px
</style>
