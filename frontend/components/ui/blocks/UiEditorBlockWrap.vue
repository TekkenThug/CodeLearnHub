<template>
    <div :class="$style.UiEditorBlockWrap">
        <div
            v-for="block in blocks"
            :key="block.id"
            :class="$style.block"
        >
            <UiEditorBlockHeader
                v-if="block.type === 'header'"
                :text="block.data.text"
                :level="block.data.level"
            />

            <UiEditorBlockParagraph
                v-else-if="block.type === 'paragraph'"
                :text="block.data.text"
            />

            <UiEditorBlockList
                v-else-if="block.type === 'list'"
                :list="block.data.items"
                :type="block.data.style"
            />

            <UiEditorBlockCode
                v-else-if="block.type === 'code'"
                :code="block.data.code"
            />
        </div>
    </div>
</template>

<script setup>
import UiEditorBlockHeader from './UiEditorBlockHeader'
import UiEditorBlockParagraph from './UiEditorBlockParagraph'
import UiEditorBlockList from './UiEditorBlockList'
import UiEditorBlockCode from './UiEditorBlockCode'

const props = defineProps({
    blocks: {
        type: Array,
        default: null
    }
})
</script>

<style lang="sass" module>
.UiEditorBlockWrap
    .block
        &:not(:last-child)
            margin-bottom: $offset-xs

        a
            color: $blue-main
            text-decoration: underline
</style>
