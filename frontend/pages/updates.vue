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

                <ul v-else>
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
                                Дата: {{ item.created_at }}
                            </strong>
                        </div>

                        <div v-html="item.text" />
                    </li>
                </ul>
            </transition>
        </div>
    </main>
</template>

<script lang="ts" setup>
const isLoading = ref(true)
const http = useHttp()

const updates = ref([
    {
        title: 'Версия v.0.1.0',
        date: '12.05.2023',
        text: 'Первый патч вышел!'
    },
    {
        title: 'Версия v.0.1.0',
        date: '12.05.2023',
        text: 'Первый патч вышел!'
    }
])

onBeforeMount(async() => {
    const { data } = await http.get('/api/v1/news')

    updates.value = data.data.news.map(item => ({ ...item, created_at: new Date(item.created_at).toLocaleDateString() }))
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
    margin-bottom: $offset-l

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

.articleDate
    font-weight: 500
    font-size: 14px
</style>
