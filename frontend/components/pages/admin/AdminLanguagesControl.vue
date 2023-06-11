<template>
    <div>
        <div :class="$style.block">
            <h2 :class="$style.title">
                Создать язык
            </h2>

            <div :class="$style.addRow">
                <UiInput
                    v-model="title"
                    :class="$style.input"
                    placeholder="Названия языка программирования"
                />

                <UiButton
                    :is-loading="addLanguageIsLoading"
                    :disabled="!title"
                    @click="sendLanguage"
                >
                    Добавить
                </UiButton>
            </div>
        </div>

        <div :class="$style.block">
            <h2 :class="$style.title">
                Список языков
            </h2>

            <transition name="fade" mode="out-in">
                <UiLoader v-if="languagesIsLoading" />

                <UiTable
                    v-else-if="languages && languages.length"
                    :head="tableHead"
                    :rows="languages"
                />

                <h3 v-else>
                    Языков нет
                </h3>
            </transition>
        </div>
    </div>
</template>

<script setup>
import { useAdminStore } from '~/stores/admin'
import UiInput from '~/components/ui/UiInput'
import UiLoader from '~/components/ui/UiLoader'
import UiButton from '~/components/ui/buttons/UiButton'
import UiTable from '~/components/ui/table/UiTable'

const admin = useAdminStore()
const notify = useToast()
const title = ref('')
const languages = ref([])
const languagesIsLoading = ref(true)
const addLanguageIsLoading = ref(false)

const tableHead = [
    {
        title: 'ID',
        key: 'id'
    },
    {
        title: 'Название',
        key: 'name'
    }
]

onBeforeMount(async() => {
    const { data } = await admin.getLanguages()
    languages.value = data
    languagesIsLoading.value = false
})

const sendLanguage = async() => {
    if (languagesIsLoading.value) {
        return
    }

    addLanguageIsLoading.value = true

    try {
        const { message, data } = await admin.postLanguage(title.value)

        notify.success(message)
        languages.value.push(data)
        title.value = ''
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    } finally {
        addLanguageIsLoading.value = false
    }
}
</script>

<style lang="sass" module>
.title
    @include h2
    color: $blue-main
    margin-bottom: $offset-xs

.block
    &:not(:last-child)
        margin-bottom: $offset-xl

.addRow
    width: 100%
    display: flex

.input
    margin-right: $offset-s
    flex-grow: 1
</style>
