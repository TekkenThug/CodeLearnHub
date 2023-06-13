<template>
    <VueFinalModal
        :class="$style.SettingsDeleteModal"
        :content-class="$style.content"
        overlay-transition="vfm-fade"
        content-transition="vfm-fade"
    >
        <h3 :class="$style.title">
            Подробная информация о обращении
        </h3>

        <div>
            <div :class="$style.row">
                <strong>ID:</strong> <span>{{ data.id }}</span>
            </div>

            <div :class="$style.row">
                <strong>E-mail:</strong> <span>{{ data.email }}</span>
            </div>

            <div :class="$style.row">
                <strong>Тема:</strong> <span>{{ data.theme }}</span>
            </div>

            <div :class="$style.row">
                <strong>Текст:</strong> <span>{{ data.text }}</span>
            </div>

            <div :class="$style.row">
                <strong>Дата создания:</strong> <span>{{ data.created_at }}</span>
            </div>

            <div :class="$style.row">
                <strong>Дата обновления</strong> <span>{{ data.updated_at }}</span>
            </div>
        </div>

        <div :class="$style.bottom">
            <UiButton
                v-if="data.resolve === 'Нет'"
                :class="$style.acceptButton"
                @click="handleClick"
            >
                {{ acceptButtonText }}
            </UiButton>

            <UiButton
                type="secondary"
                @click="closeAll"
            >
                Отмена
            </UiButton>
        </div>
    </VueFinalModal>
</template>

<script setup>
import { VueFinalModal } from 'vue-final-modal'
import { useAdminStore } from '~/stores/admin'
import UiButton from '~/components/ui/buttons/UiButton'

const admin = useAdminStore()

const notify = useToast()

const props = defineProps({
    data: {
        type: Object,
        default: () => ({})
    },

    mode: {
        type: String,
        default: 'my'
    }
})

const { closeAll } = useVfm()

const takeTicket = async() => {
    try {
        const { message } = await admin.takeTicket(props.data.id)

        notify.success(message)
        closeAll()
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    }
}

const closeTicket = async() => {
    try {
        const { message } = await admin.closeTicket(props.data.id)

        notify.success(message)
        closeAll()
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    }
}

const handleClick = async() => {
    if (props.mode === 'active') {
        await takeTicket()
    } else if (props.mode === 'my') {
        await closeTicket()
    }
}

const acceptButtonText = computed(() => {
    return props.mode === 'my' ? 'Разрешить обращение' : 'Взять в обработку'
})
</script>

<style lang="sass" module>
.SettingsDeleteModal
    display: flex
    justify-content: center
    align-items: center

.content
    padding: $offset-s
    background-color: $white
    border-radius: $r-m
    max-width: 800px

.title
    @include h2
    color: $blue-main
    margin-bottom: $offset-xxs

.row
    display: flex

    &:not(:last-child)
        margin-bottom: $offset-xs

    strong
        margin-right: $offset-xs

.bottom
    margin-top: $offset-m

    @include responsive($mobile)
        display: flex
        flex-direction: column

.acceptButton
    margin-right: $offset-xxs

    @include responsive($mobile)
        margin-right: 0
        margin-bottom: $offset-xxs
</style>
