<template>
    <div>
        <div>
            <div v-if="comments.length" :class="$style.commentCount">
                {{ commentsTotalText }}
            </div>

            <div :class="$style.form">
                <img
                    v-if="avatar"
                    :class="$style.formImage"
                    :src="avatar"
                    alt="Avatar"
                >

                <img
                    v-else="avatar"
                    :class="$style.formImage"
                    src="~/assets/images/common/default-avatar.png"
                    alt="Avatar"
                >

                <div :class="$style.formContent">
                    <UiTextarea
                        v-model="text"
                        :class="$style.formText"
                        placeholder="Текст комментария"
                    />

                    <UiButton
                        :disabled="text.length < 5"
                        @click="$emit('sendComment', text)"
                    >
                        Отправить
                    </UiButton>
                </div>
            </div>

            <ul :class="$style.commentList">
                <li
                    v-for="item in comments"
                    :key="item.id"
                    :class="$style.commentItem"
                >
                    <LessonCommentItem
                        :author="item.user.nickname"
                        :text="item.content"
                        :date="item.added_at"
                        :image="item.user.avatar"
                    />
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { pluralize } from '~/utils/string'
import LessonCommentItem from '~/components/pages/lesson/comment/LessonCommentItem.vue'
import UiTextarea from '~/components/ui/UiTextarea.vue'
import UiButton from '~/components/ui/buttons/UiButton.vue'

const emit = defineEmits(['sendComment'])
const props = defineProps({
    comments: {
        type: Array,
        default: () => ([])
    },

    avatar: {
        type: String,
        default: ''
    }
})
const text = ref('')

const commentsTotalText = computed(() => {
    return `${props.comments.length} ${pluralize(props.comments.length, ['комментарий', 'комментария', 'комментариев'])}`
})
</script>

<style lang="sass" module>
.commentCount
    font-size: 24px
    line-height: 32px
    font-weight: 500
    margin-bottom: $offset-m

.form
    display: flex
    margin-bottom: $offset-xs

.formImage
    width: 50px
    height: 50px
    border-radius: 50%
    margin-right: $offset-xs

.formContent
    flex-grow: 1

.formText
    textarea
        min-height: 120px
        height: 120px

.commentList
    overflow: scroll

.commentItem
    &:not(:last-child)
        margin-bottom: $offset-xs
</style>
