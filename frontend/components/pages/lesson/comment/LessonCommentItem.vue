<template>
    <div :class="$style.LessonCommentItem">
        <img
            v-if="image"
            :src="image"
            alt="Image"
        >

        <img
            v-else
            src="~/assets/images/common/default-avatar.png"
            alt="Image"
        >

        <div :class="$style.content">
            <h5 :class="$style.author">
                {{ author }}
            </h5>

            <strong :class="$style.date">{{ mappedDate }}</strong>

            <p :class="$style.text">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    image: {
        type: String,
        default: ''
    },
    author: {
        type: String,
        default: ''
    },
    date: {
        type: String,
        default: ''
    },
    text: {
        type: String,
        default: ''
    }
})

const mappedDate = computed(() => {
    const date = new Date(props.date)
    return `${date.toLocaleDateString()} ${date.toLocaleTimeString('ru-RU', { hour: 'numeric', minute: 'numeric' })}`
})
</script>

<style lang="sass" module>
.LessonCommentItem
    display: flex
    padding: 10px
    border-radius: $r-m
    background-color: $gray-50

    & > img
        width: 50px
        height: 50px
        border-radius: 50%
        flex-shrink: 0
        margin-right: $offset-xs

.content
    display: flex
    flex-direction: column

.author
    @include h3
    color: $blue-main
    line-height: 24px

.date
    font-size: 12px

.text
    margin-top: 5px
</style>
