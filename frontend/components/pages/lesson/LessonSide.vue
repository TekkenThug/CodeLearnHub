<template>
    <aside :class="$style.LessonSide">
        <ul :class="$style.navigation">
            <li
                :class="[$style.navigationItem, { [$style['_active']]: activeTab === 'lesson' }]"
                @click="setActiveTab('lesson')"
            >
                Урок
            </li>

            <li
                :class="[$style.navigationItem, { [$style['_active']]: activeTab === 'comments' }]"
                @click="setActiveTab('comments')"
            >
                Комментарии
            </li>
        </ul>

        <div :class="$style.content">
            <transition name="fade" mode="out-in">
                <div
                    v-if="activeTab === 'lesson'"
                    :class="$style.description"
                    v-html="description"
                />

                <LessonCommentSection
                    v-else-if="activeTab === 'comments'"
                    :class="$style.commentSection"
                    :comments="comments"
                    :avatar="avatar"
                    @send-comment="(text) => $emit('sendComment', text)"
                />
            </transition>
        </div>
    </aside>
</template>

<script setup>
import LessonCommentSection from '~/components/pages/lesson/comment/LessonCommentSection'

const emits = defineEmits(['sendComment'])
const props = defineProps(
    {
        description: {
            type: String,
            default: ''
        },

        comments: {
            type: Array,
            default: () => ([])
        },

        avatar: {
            type: String,
            default: ''
        }
    }
)

const activeTab = ref('lesson')
const setActiveTab = (tabName) => {
    activeTab.value = tabName
}
</script>

<style lang="sass" module>
.LessonSide
    border-radius: $r-s
    background-color: #fff
    border: 1px solid $gray-100
    overflow: auto

.navigation
    display: flex
    justify-content: center
    border-bottom: 1px solid $gray-100
    color: $blue-main
    background-color: #fff

.navigationItem
    @include trans
    padding: $offset-xs
    cursor: pointer

    &._active
        background-color: $gray-100
        color: $blue-dark

    @include hover
        background-color: $gray-100
        color: $blue-dark

.content
    padding: $offset-xs

.commentSection
    @include responsive($tablet)
        max-height: 320px

.description
    line-height: 24px
</style>
