<template>
    <div>
        <div :class="$style.block">
            <h2 :class="$style.title">
                Мои обращения
            </h2>

            <transition name="fade" mode="out-in">
                <UiLoader
                    v-if="myTicketsLoading"
                />

                <UiTable
                    v-else-if="myTickets && myTickets.length"
                    :head="tableHead"
                    :rows="myTickets"
                    :has-clicked-row="true"
                    @row-click="id => openModalWithTicket(id, 'my')"
                />

                <h3 v-else>
                    Вы не обрабатывали обращения
                </h3>
            </transition>
        </div>

        <div :class="$style.block">
            <h2 :class="$style.title">
                Активные обращения
            </h2>

            <transition name="fade" mode="out-in">
                <UiLoader
                    v-if="activeTicketsLoading"
                />

                <UiTable
                    v-else-if="activeTickets && activeTickets.length"
                    :head="tableHead"
                    :rows="activeTickets"
                    :has-clicked-row="true"
                    @row-click="id => openModalWithTicket(id, 'active')"
                />

                <h3 v-else>
                    Активных обращений нет
                </h3>
            </transition>
        </div>
    </div>
</template>

<script setup>
import AdminTicketControlModal from './AdminTicketControlModal'
import { getArrayWithMappedDates } from '~/utils/time'
import { useAdminStore } from '~/stores/admin'
import UiLoader from '~/components/ui/UiLoader'
import UiTable from '~/components/ui/table/UiTable'

const admin = useAdminStore()

const notify = useToast()

const myTicketsLoading = ref(true)
const activeTicketsLoading = ref(true)

const myTickets = ref([])
const activeTickets = ref([])

const { open: openPopup, patchOptions } = useModal({
    component: AdminTicketControlModal,
})

const tableHead = [
    {
        title: 'ID',
        key: 'id'
    },
    {
        title: 'Тема',
        key: 'theme'
    },
    {
        title: 'E-mail',
        key: 'email'
    },
    {
        title: 'Создано',
        key: 'created_at'
    },
    {
        title: 'Обновлено',
        key: 'updated_at'
    },
    {
        title: 'Разрешено',
        key: 'resolve'
    }
]

const getMyTickets = async() => {
    myTicketsLoading.value = true
    const { data } = await admin.getMyTickets()
    myTickets.value = getArrayWithMappedDates(data.map(item => ({ ...item, resolve: item.resolve ? 'Да' : 'Нет' })))
    myTicketsLoading.value = false
}

const getActiveTickets = async() => {
    activeTicketsLoading.value = true
    const { data } = await admin.getActiveTickets()
    activeTickets.value = getArrayWithMappedDates(data.map(item => ({ ...item, resolve: item.resolve ? 'Да' : 'Нет' })))
    activeTicketsLoading.value = false
}

const getData = async() => {
    try {
        await Promise.all([
            getMyTickets(),
            getActiveTickets()
        ])
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    }
}

onBeforeMount(async() => {
    await getData()
})

const openModalWithTicket = (id, mode) => {
    patchOptions({
        attrs: {
            data: mode === 'my'
                ? myTickets.value.find(ticket => ticket.id === id)
                : activeTickets.value.find(ticket => ticket.id === id),
            mode,
            onClosed() {
                getData()
            }
        }
    })
    openPopup()
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
</style>
