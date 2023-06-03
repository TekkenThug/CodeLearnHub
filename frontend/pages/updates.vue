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

                        <div
                            :class="$style.text"
                            v-html="item.text"
                        />
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
const isLoading = ref(true)
const http = useHttp()

const updates = ref([])

onBeforeMount(async() => {
    const { data } = await http.get('/api/v1/news').then(({ data }) => data)

    updates.value = data.news.map(item => ({ ...item, added_at: new Date(item.added_at).toLocaleDateString() }))
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
        padding-top: 70px

        @include responsive($mobile)
            padding-top: 40px

    &:not(:last-child)
        position: relative
        padding-bottom: 70px
        border-bottom: 1px solid $gray-100

        @include responsive($mobile)
            padding-bottom: 40px

.articleTop
    margin-bottom: $offset-s
    color: $blue-dark-card

.articleTitle
    @include h2
    font-size: 24px
    margin-bottom: 8px

.articleDate
    font-weight: 500
    font-size: 14px

.text
    p
        margin-bottom: $offset-xs

    ul
        padding-left: $offset-xs

    li
        list-style-type: circle

        &:first-child
            margin-top: 5px

        &:not(:last-child)
            margin-bottom: $offset-xxs
</style>
