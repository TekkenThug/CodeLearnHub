<template>
    <div >
        <transition name="fade" mode="out-in">
            <UiLoader
                v-if="isLoading"
            />

            <div v-else :class="$style.table">
                <div :class="$style.head">
                    <div :class="$style.cell">
                        E-mail
                    </div>

                    <div :class="$style.cell">
                        Никнейм
                    </div>

                    <div :class="$style.cell">
                        Роли
                    </div>

                    <div :class="$style.cell">
                        Действия
                    </div>
                </div>

                <div
                    v-for="user in users"
                    :key="user.id"
                    :class="$style.row"
                >
                    <div :class="$style.cell">
                        {{ user.email }}
                    </div>

                    <div :class="$style.cell">
                        {{ user.nickname }}
                    </div>

                    <div :class="$style.cell">
                        Администратор
                    </div>

                    <div :class="$style.cell">
                        <button :class="[$style.actionButton, $style['_delete']]">
                            <Icon name="bi:trash" />
                        </button>

                        <button :class="[$style.actionButton, $style['_edit']]">
                            <Icon name="bi:pen" />
                        </button>
                    </div>

                    <!--                <UiExpander-->
                    <!--                    :is-open="true"-->
                    <!--                    :class="$style.expander"-->
                    <!--                >-->
                    <!--                    <UiInput placeholder="Email" />-->

                    <!--                    <UiInput placeholder="Никнейм" />-->
                    <!--                </UiExpander>-->
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import UiLoader from '~/components/ui/UiLoader'
import UiExpander from '~/components/ui/expander/UiExpander'
import UiInput from '~/components/ui/UiInput'
import { useAdminStore } from '~/stores/admin'

const notify = useToast()
const adminStore = useAdminStore()
const users = ref([])
const isLoading = ref(true)

onBeforeMount(async() => {
    // isLoading.value = true

    try {
        const { data } = await adminStore.getUserList()

        users.value = data.users
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }

        navigateTo('/')
    } finally {
        isLoading.value = false
    }
})

const extractRole = value => extractRole(value)
</script>

<style lang="sass" module>
.table
    box-shadow: 0px 20px 30px rgba(48, 175, 255, 0.2)

.row,
.head
    display: flex
    align-items: center
    padding: $offset-xs $offset-m
    background-color: #fff
    text-align: left

.row
    flex-wrap: wrap

    &:last-of-type
        border-bottom-right-radius: $r-m
        border-bottom-left-radius: $r-m

.head
    font-weight: 600
    border-bottom: 1px solid $gray-300

.cell
    flex-shrink: 0
    flex-grow: 0

    &:first-child
        width: 240px
        word-break: break-all

    &:nth-child(2)
        width: 200px
        word-break: break-all

    &:last-child
        display: flex
        margin-left: auto

.head
    border-top-right-radius: $r-m
    border-top-left-radius: $r-m

.expander
    width: 100%

.actionButton
    display: flex
    align-items: center
    justify-content: center
    width: 25px
    height: 25px
    border-radius: $r-s
    cursor: pointer
    color: #fff

    svg
        flex-shrink: 0
        width: 15px
        height: 15px

    &._delete
        background-color: $error-500

    &._edit
        background-color: $secondary-500
        margin-left: 5px
</style>
