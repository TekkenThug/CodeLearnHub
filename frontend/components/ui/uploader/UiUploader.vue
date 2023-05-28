<template>
    <div :class="$style.UiUploader">
        <input
            type="file"
            :accept="accept"
            :class="$style.input"
            @change="handleFileChange"
        >

        <img
            v-if="preview"
            :src="preview"
            alt="Image"
            :class="$style.image"
        >

        <img
            v-else-if="initialImage"
            :src="initialImage"
            alt="Image"
            :class="$style.image"
        >

        <img
            v-else
            src="~/assets/images/common/default-avatar.png"
            alt="Image"
            :class="$style.image"
        >

        <span :class="$style.overlay">
            <Icon name="bi:camera" />

            {{ uploadCaption }}
        </span>
    </div>
</template>

<script lang="ts" setup>
const emit = defineEmits<{(e: 'uploaded', value: Blob | MediaSource): void }>()

interface Props {
    accept?: string,
    uploadCaption?: string,
    initialImage?: string
}
const props = withDefaults(defineProps<Props>(), {
    accept: 'images/*',
    uploadCaption: 'Загрузить',
    initialImage: ''
})

const uploadedFile = ref(null)
const preview = ref<string| null>(null)

const handleFileChange = (event) => {
    uploadedFile.value = event.target.files[0]
    preview.value = URL.createObjectURL(uploadedFile.value)
    emit('uploaded', uploadedFile.value)
}
</script>

<style lang="sass" module>
.UiUploader
    position: relative
    width: 50px
    height: 50px
    border-radius: 50%
    overflow: hidden
    cursor: pointer
    user-select: none

    @include hover
        .overlay
            opacity: 1
            visibility: visible

.input
    position: absolute
    top: 0
    left: 0
    width: 100%
    height: 100%
    opacity: 0
    cursor: pointer
    z-index: 2

.image
    display: block
    width: 100%
    height: 100%
    object-fit: cover
    object-position: center

.overlay
    @include trans
    display: flex
    flex-direction: column
    justify-content: center
    align-items: center
    color: #fff
    position: absolute
    top: 0
    left: 0
    z-index: 1
    width: 100%
    height: 100%
    opacity: 0
    visibility: hidden
    background-color: rgba(#000, .7)
    font-size: 12px
</style>
