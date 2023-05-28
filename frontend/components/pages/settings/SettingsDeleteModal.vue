<template>
    <VueFinalModal
        :class="$style.SettingsDeleteModal"
        :content-class="$style.content"
        overlay-transition="vfm-fade"
        content-transition="vfm-fade"
    >
        <div :class="$style.top">
            <h3 :class="$style.title">
                Вы уверены, что хотите удалить аккаунт?
            </h3>

            <p>
                Все данные Вашего аккаунта будут удалены.
                Восстановить его будет невозможно.
            </p>
        </div>

        <div>
            <UiButton
                type="danger"
                :class="$style.deleteButton"
                @click="deleteAccount"
            >
                Удалить
            </UiButton>

            <UiButton @click="closeAll">
                Отмена
            </UiButton>
        </div>
    </VueFinalModal>
</template>

<script lang="ts" setup>
import { VueFinalModal } from 'vue-final-modal'
import { useUserStore } from '~/stores/user'

const userStore = useUserStore()
const { closeAll } = useVfm()

const deleteAccount = async() => {
    await userStore.deleteUser()

    navigateTo('/')
}
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
    max-width: 420px

.title
    @include h2
    margin-bottom: $offset-xxs

.top
    margin-bottom: $offset-xl

.deleteButton
    margin-right: $offset-xxs
</style>
