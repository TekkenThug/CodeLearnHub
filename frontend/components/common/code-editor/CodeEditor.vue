<template>
    <div :class="$style.CodeEditor">
        <div ref="content">
            {{ preparedCode }}
        </div>
    </div>
</template>

<script setup>
import CodeFlask from 'codeflask'
// import { languages } from 'prismjs'

const emits = defineEmits(['change'])
const props = defineProps({
    preparedCode: {
        type: String,
        default: ''
    },

    language: {
        type: String,
        default: 'js',
        validate: v => ['js'].includes(v)
    }
})

const editorInstance = ref(null)
const content = ref(null)

onMounted(() => {
    editorInstance.value = new CodeFlask(content.value, {
        language: 'js',
        lineNumbers: true,
        enableAutocorrect: true,
        tabSize: 4
    })

    // editorInstance.value.addLanguage('java', languages.java)

    editorInstance.value.onUpdate((code) => {
        console.log('bebra')
        content.value = code
        emits('change', content.value)
    })
})

onBeforeUnmount(() => {
    // editorInstance.value.destroy()
})
</script>

<style lang="sass" module>
.CodeEditor
    border-radius: $r-s
    background-color: #fff
    border: 1px solid $gray-100
    position: relative
    height: 380px
</style>
