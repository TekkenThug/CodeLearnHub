<template>
    <div>
        <div>
            <h2 :class="$style.title">
                Создать новость
            </h2>

            <UiInput
                v-model="title"
                placeholder="Заголовок новости"
            />

            <UiEditor
                :class="$style.editor"
                :clear="isClear"
                placeholder="Содержимое новости"
                @change="setContent"
                @clear="isClear = false"
            />

            <UiButton
                :disabled="disabled"
                @click="sendNews"
            >
                Создать новость
            </UiButton>
        </div>
    </div>
</template>

<script setup>
import { useAdminStore } from '~/stores/admin'
import UiInput from '~/components/ui/UiInput'
import UiEditor from '~/components/ui/UiEditor'
import UiButton from '~/components/ui/buttons/UiButton'

const admin = useAdminStore()
const notify = useToast()
const title = ref('')
const text = ref(null)
const isClear = ref(false)

const setContent = (value) => {
    text.value = value
}

const disabled = computed(() => {
    return !title.value || !text.value || !text.value.length
})

const sendNews = async() => {
    if (disabled.value) {
        return
    }

    try {
        const { message } = await admin.postNews({ title: title.value, text: JSON.stringify(text.value) })

        notify.success(message)

        isClear.value = true
        title.value = ''
    } catch (e) {
        notify.error(e.response.data.error || e.response.data.message)
    }
}
</script>

<style lang="sass" module>
.title
    @include h2
    color: $blue-main
    margin-bottom: $offset-xs

.editor
    margin: $offset-xs 0
</style>
