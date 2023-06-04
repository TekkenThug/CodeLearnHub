<template>
    <div :class="$style.LessonEditor">
        <div :class="$style.editorWrapper">
            <div
                ref="content"
                :class="$style.editor"
            >
                {{ layoutCode }}
            </div>
        </div>

        <UiButton
            :class="$style.button"
        >
            Отправить на тестирование
        </UiButton>
    </div>
</template>

<script setup>
import CodeFlask from 'codeflask'
import { languages } from 'prismjs'
import UiButton from '~/components/ui/buttons/UiButton.vue'

const props = defineProps({
    layoutCode: {
        type: String,
        default: ''
    }
})

const editorInstance = ref(null)
const content = ref(null)

onMounted(() => {
    editorInstance.value = new CodeFlask(content.value, {
        language: 'js',
        lineNumbers: true
    })

    editorInstance.value.addLanguage('java', languages.java)
})
</script>

<style lang="sass" module>
.editorWrapper
    border-radius: $r-s
    background-color: #fff
    border: 1px solid $gray-100
    position: relative
    height: 70%

    @include responsive($tablet)
        height: 380px

.button
    margin-top: $offset-xs

    @include responsive($tablet)
        width: 100%
</style>
