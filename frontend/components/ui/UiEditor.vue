<template>
    <div>
        <div
            ref="element"
            :class="$style.editor"
        />
    </div>
</template>

<script setup>
import EditorJS from '@editorjs/editorjs'
import Header from '@editorjs/header'
import List from '@editorjs/list'

const emits = defineEmits(['change', 'clear'])
const props = defineProps({
    placeholder: {
        type: String,
        default: ''
    },

    clear: {
        type: Boolean,
        default: false
    }
})
const element = ref(null)
const editor = ref(null)

onMounted(() => {
    editor.value = new EditorJS({
        holder: element.value,

        tools: {
            header: Header,
            list: List
        },

        placeholder: props.placeholder,

        onChange: async() => {
            const { blocks } = await editor.value.save()
            emits('change', blocks)
        }
    })
})

onBeforeUnmount(() => {
    editor.value.destroy()
})

watch(() => props.clear, (value) => {
    if (value) {
        editor.value.clear()
        emits('clear')
    }
})

</script>

<style lang="sass" module>
.editor
    background-color: #fff
</style>
