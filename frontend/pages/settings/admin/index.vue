<template>
    <form
        novalidate
        :class="$style.Form"
        @submit.prevent
    >
        <UiOverlay
            :class="$style.loadingOverlay"
            :is-loading="isLoading"
        />

        <div :class="$style.row">
            <div :class="$style.fieldWrapper">
                <UiUploader
                    :class="$style.avatar"
                    :initial-image="initialValues.avatar"
                    upload-caption="Загрузить"
                    @uploaded="setAvatar"
                />
            </div>
        </div>

        <div :class="$style.fieldList">
            <div :class="$style.row">
                <div :class="$style.fieldWrapper">
                    <span>Никнейм</span>

                    <UiInput
                        v-model="nickname"
                        placeholder="Никнейм"
                        :error-message="errors.nickname"
                        name="nickname"
                    />
                </div>
            </div>

            <div :class="$style.row">
                <div :class="$style.fieldWrapper">
                    <span>E-main</span>

                    <UiInput
                        v-model="email"
                        placeholder="E-mail"
                        type="email"
                        :error-message="errors.email"
                    />
                </div>
            </div>

            <div :class="$style.row">
                <div :class="$style.fieldWrapper">
                    <span>Пароль</span>

                    <UiInput
                        v-model="password"
                        placeholder="Новый пароль"
                        type="password"
                        name="password"
                        :error-message="errors.password"
                    />
                </div>
            </div>

            <UiButton
                :disabled="buttonIsDisabled"
                @click="submitForm"
            >
                Сохранить
            </UiButton>

            <UiButton
                type="danger"
                :class="$style.deleteButton"
                @click="openDeleteModal"
            >
                Удалить аккаунт
            </UiButton>
        </div>
    </form>
</template>

<script lang="ts" setup>
import { useField, useForm } from 'vee-validate'
import { toFormValidator } from '@vee-validate/zod'
import { z } from 'zod'
import { useUserStore } from '~/stores/user'
import { EMAIL_ERROR, PASSSWORD_ERROR, REQUIRED_ERROR } from '~/utils/data/validateErrors'
import { PASSWORD_REGEXP } from '~/utils/data/regexp'
import SettingsDeleteModal from '~/components/pages/settings/SettingsDeleteModal.vue'
import UiUploader from '~/components/ui/uploader/UiUploader.vue'

const { open: openDeleteModal } = useModal({
    component: SettingsDeleteModal
})

const notify = useToast()
const userStore = useUserStore()

const initialValues = computed(() => {
    return {
        email: userStore?.user?.email,
        nickname: userStore?.user?.nickname,
        avatar: userStore?.user?.avatar
    }
})

const validationSchema = toFormValidator(
    z.object({
        email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR }),
        nickname: z.string().trim().nonempty(REQUIRED_ERROR),
        password: z.string().trim().regex(PASSWORD_REGEXP, PASSSWORD_ERROR).optional()
    })
)
const isLoading = ref(false)
const { handleSubmit, errors } = useForm({ validationSchema, initialValues })
const { value: email } = useField<string>('email', 'isRequired', {
    validateOnValueUpdate: false
})
const { value: nickname } = useField<string>('nickname', 'isRequired', {
    validateOnValueUpdate: false
})
const { value: password } = useField<string>('password', '', { validateOnValueUpdate: false })
const avatar = ref(null)

const setAvatar = (blob) => {
    avatar.value = blob
}

const buttonIsDisabled = computed(() => {
    return (!email.value ||
        email.value === initialValues.value.email) &&
        (nickname.value === initialValues.value.nickname ||
        !nickname.value) && !password.value && !avatar.value
})

const submitForm = handleSubmit(async() => {
    const dataToSend: {
        email?: string,
        nickname?: string,
        password?: string
    } = {}

    if (email.value !== initialValues.value.email) {
        dataToSend.email = email.value
    }

    if (nickname.value !== initialValues.value.nickname) {
        dataToSend.nickname = nickname.value
    }

    if (password.value) {
        dataToSend.password = password.value
    }

    isLoading.value = true

    try {
        if (avatar.value) {
            await userStore.uploadAvatar(avatar.value)
        }

        const res = await userStore.updateUserData(dataToSend)

        if (res.message) {
            notify.success(res.message)
        }

        if (res.data.user) {
            userStore.setUserData(res.data.user, true)
        }

        password.value = ''
    } catch (e) {
        const error = e.response?.data?.error || e.message

        if (error) {
            notify.error(error)
        }
    } finally {
        isLoading.value = false
    }
})
</script>

<style lang="sass" module>
.Form
    display: flex

    @include responsive($mobile)
        flex-direction: column
        align-items: center

.loadingOverlay
    position: absolute
    width: 100%
    height: 100%
    top: 0
    left: 0

.fieldList
    display: flex
    flex-direction: column
    margin-left: auto
    width: 380px

    @include responsive($mobile)
        width: 100%

.row
    margin-bottom: $offset-m

.avatar
    width: 240px
    height: 240px

.fieldWrapper
    display: flex
    flex-direction: column

    & > span
        font-weight: 500
        margin-bottom: 8px

.deleteButton
    margin-top: $offset-xxs
</style>
